<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YouTubeService
{
    public function __construct(protected AIService $aiservice){}

    public function fetchPlaylists(array $titles): array
    {
        $allResults = [];
        $search_url = config('youtube.endpoints.search');

        foreach ($titles as $title) {
            try {
                $response = Http::get($search_url, [
                    'part' => 'snippet',
                    'q' => $title,
                    'type' => 'playlist',
                    'maxResults' => 2,
                    'key' => config('youtube.key'),
                ]);

                if ($response->successful()) {
                    $items = $response->json()['items'] ?? [];
                    $allResults = array_merge($allResults, $items);
                }
            } catch (\Exception $e) {
                Log::error("Failed fetching for title: {$title}. Error: " . $e->getMessage());
                continue; 
            }
        }

        return $allResults;
    }
}