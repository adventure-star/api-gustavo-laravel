<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
   // public routes
   Route::post('/login', 'Api\AuthController@login')->name('login.api');
   Route::post('/register', 'Api\AuthController@register')->name('register.api');
   Route::get('/images/all', 'Api\CommonController@images')->name('common.images.all.api');
   Route::get('/videos/all', 'Api\CommonController@videos')->name('common.videos.all.api');
   Route::get('/texts/all', 'Api\CommonController@texts')->name('common.texts.all.api');
   Route::get('/animations/all', 'Api\CommonController@animations')->name('common.animations.all.api');
   Route::get('/presentations/all', 'Api\CommonController@presentations')->name('common.presentations.all.api');
   Route::get('/linkvideos/all', 'Api\CommonController@linkvideos')->name('common.linkvideos.all.api');
   Route::get('/lesson/recent', 'Api\CommonController@recentLessons')->name('common.recent.lesson.api');
   Route::post('/lesson/create', 'Api\CommonController@createLesson')->name('common.create.lesson.api');
   Route::get('/lesson/{id}', 'Api\CommonController@getLessonById')->name('common.get.lesson.api');
   Route::put('/lesson/{id}', 'Api\CommonController@updateLesson')->name('common.update.lesson.api');

   Route::post('/lesson/historycreate', 'Api\CommonController@createLessonHistory')->name('common.create.lessonhistory.api');
   Route::get('/lesson/recenthistory', 'Api\CommonController@getLessonHistory')->name('common.recent.lessonhistory.api');


   // private routes
   Route::middleware('auth:api')->group(function () {
       Route::get('/logout', 'Api\AuthController@logout')->name('logout');
   });

   
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
