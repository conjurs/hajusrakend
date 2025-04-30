<?php

namespace App\Http\Controllers;

use App\Services\SpotifyService;
use Illuminate\Http\Request;

class SpotifyController extends Controller
{
    private $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }

    public function index()
    {
        if (!session('spotify_token')) {
            return view('spotify.login', [
                'authUrl' => $this->spotifyService->getAuthUrl()
            ]);
        }

        $this->spotifyService->setAccessToken(session('spotify_token'));
        $playlists = $this->spotifyService->getUserPlaylists();

        return view('spotify.index', [
            'playlists' => $playlists
        ]);
    }

    public function callback(Request $request)
    {
        $token = $this->spotifyService->getAccessToken($request->code);
        session(['spotify_token' => $token]);

        return redirect()->route('spotify.index');
    }

    public function addTracks(Request $request)
    {
        $request->validate([
            'songs' => 'required|string',
            'playlist_id' => 'required|string'
        ]);

        $this->spotifyService->setAccessToken(session('spotify_token'));

        $songs = array_filter(explode("\n", $request->songs));
        $trackUris = [];

        foreach ($songs as $song) {
            $track = $this->spotifyService->searchTrack($song);
            if ($track) {
                $trackUris[] = $track->uri;
            }
        }

        if (!empty($trackUris)) {
            $this->spotifyService->addTracksToPlaylist($request->playlist_id, $trackUris);
            return redirect()->route('spotify.index')->with('success', 'Tracks added successfully!');
        }

        return redirect()->route('spotify.index')->with('error', 'No tracks were found to add.');
    }
} 