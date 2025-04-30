<?php

namespace App\Services;

use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

class SpotifyService
{
    private $api;
    private $session;

    public function __construct()
    {
        $clientId = "5e7761d5c95b4aada1139bceefa9c227";
        $clientSecret = "55bea4455e8a4572b7115c91dcc7df80";
        $redirectUrl = "https://hajusrakendused.tak22parnoja.itmajakas.ee/current/public/index.php/spotify/callback";

        $this->session = new Session($clientId, $clientSecret, $redirectUrl);
        $this->api = new SpotifyWebAPI();
    }

    public function getAuthUrl()
    {
        $options = [
            'scope' => [
                'playlist-read-private',
                'playlist-modify-public',
                'playlist-modify-private',
            ],
        ];

        return $this->session->getAuthorizeUrl($options);
    }

    public function getAccessToken($code)
    {
        $this->session->requestAccessToken($code);
        $accessToken = $this->session->getAccessToken();
        $refreshToken = $this->session->getRefreshToken();
        
        session([
            'spotify_token' => $accessToken,
            'spotify_refresh_token' => $refreshToken,
            'spotify_token_expires' => time() + 3600
        ]);
        
        return $accessToken;
    }

    public function setAccessToken($token)
    {
        if (time() >= session('spotify_token_expires')) {
            $this->refreshToken();
        }
        
        $this->api->setAccessToken(session('spotify_token'));
    }

    private function refreshToken()
    {
        $this->session->refreshAccessToken(session('spotify_refresh_token'));
        $accessToken = $this->session->getAccessToken();
        
        session([
            'spotify_token' => $accessToken,
            'spotify_token_expires' => time() + 3600
        ]);
    }

    public function getUserPlaylists()
    {
        return $this->api->getMyPlaylists();
    }

    public function searchTrack($query)
    {
        $results = $this->api->search($query, 'track', ['limit' => 1]);
        return $results->tracks->items[0] ?? null;
    }

    public function addTracksToPlaylist($playlistId, $trackUris)
    {
        // Split track URIs into chunks of 100
        $chunks = array_chunk($trackUris, 100);
        
        // Add each chunk separately
        foreach ($chunks as $chunk) {
            $this->api->addPlaylistTracks($playlistId, $chunk);
        }
        
        return true;
    }
} 