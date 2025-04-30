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
        $this->session = new Session(
            env('SPOTIFY_CLIENT_ID'),
            env('SPOTIFY_CLIENT_SECRET'),
            env('SPOTIFY_REDIRECT_URL')
        );
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
        return $this->session->getAccessToken();
    }

    public function setAccessToken($token)
    {
        $this->api->setAccessToken($token);
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
        return $this->api->addPlaylistTracks($playlistId, $trackUris);
    }
} 