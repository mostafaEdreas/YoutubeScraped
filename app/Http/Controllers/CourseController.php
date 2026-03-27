<?php

namespace App\Http\Controllers;

use App\Services\AIService;
use App\Services\CourseService;
use App\Services\YouTubeService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(
        protected AIService $ai_service , 
        protected YouTubeService $youtubei_service , 
        protected CourseService $course_service)
    {}




    public function index()
    {

        return view('app');
          
    }

    public function scrapedYoutube(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|min:3',
        ]);

        set_time_limit(60);
        
       
      

       
        $queries = $this->ai_service->generateTitles($validated['category']);
        
        foreach ($queries as $category => $titles) {
           
            $items = $this->youtubei_service->fetchPlaylists($titles); 
            
             $courses = $this->course_service->createCourses($items , $category);
         
        }
        
        return response()->json([
            'status' => 'success',
            'count' => count($courses),
            'courses' => $courses
        ]);
    }
}
