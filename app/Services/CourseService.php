<?php

namespace App\Services ;

use App\Models\Course;

class CourseService 
{
    public function createCourses ($items ,$category):array
    {
            $allFoundCourses = [];
           foreach ($items as $item) {
              $data = $this->handlePlaylist($item,$category);
              $course =  Course::updateOrCreate(
                    ['playlist_id' => $data['playlist_id']], // Unique identifier
                    [
                        'title'        => $data['title'],
                        'description'  => $data['description'],
                        'thumbnail'    => $data['thumbnails'] ,
                        'channel_name' => $data['channel_name'],
                        'category'     => $data['category'], // From the constructor
                    ]
                );
              
                
                if ($course) {
                    $allFoundCourses[] = $course;
                }
            }
            return  $allFoundCourses ;
    }


    protected function handlePlaylist($item ,$category){
        $playlistId = $item['id']['playlistId'] ?? null;
        if (!$playlistId) return;

        return [
            'playlist_id'  => $playlistId,
            'title'        => $item['snippet']['title'],
            'description'  => $item['snippet']['description'],
            'thumbnails'   => $item['snippet']['thumbnails']['high']['url'] ?? '',
            'channel_name' => $item['snippet']['channelTitle'],
            'category'     => $category,
        ];

    }
}