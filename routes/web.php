<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;



Route::get('/',[ CourseController::class , 'index']) ;
Route::post('scraped-youtube',[ CourseController::class , 'scrapedYoutube']) ;

