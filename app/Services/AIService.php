<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class AIService 
{

   

    public function generateTitles(string $categories): array {
        $categories = collect(explode("\n", str_replace("\r", "", $categories)))
        ->map(fn($item) => trim($item))
        ->filter()
        ->unique() 
        ->all();
        $categoryList = implode(', ', $categories);
        $prompt = "For each of the following categories: [$categoryList], generate 2 YouTube search queries for educational playlists. 
               Return the result as a JSON object where the keys are the category names and the values are arrays of strings.";        
        $response = OpenAI::chat()->create([
                'model' => 'llama-3.3-70b-versatile', 
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a technical assistant that only outputs JSON.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'response_format' => ['type' => 'json_object'], // Ensures valid JSON
            ]);

            return json_decode($response->choices[0]->message->content, true);

            // Now you can loop through these and send them to your YouTube Scraper logic
 
        
    }
}