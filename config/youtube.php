<?php

$youtubeBaseApiUrl = 'https://www.googleapis.com/youtube/v3';

return [

    'key' => env('YOUTUBE_API_KEY'),
    'base_url' => $youtubeBaseApiUrl,
    'endpoints' => [
        'search'         => "{$youtubeBaseApiUrl}/search",
        'playlists'      => "{$youtubeBaseApiUrl}/playlists",
        'playlist_items' => "{$youtubeBaseApiUrl}/playlistItems",
    ],


];