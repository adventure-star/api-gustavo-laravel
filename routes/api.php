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
   Route::post('/project/create', 'Api\CommonController@createproject')->name('common.create.project.api');
   Route::get('/project/{id}', 'Api\CommonController@getProjectById')->name('common.get.project.api');

   // private routes
   Route::middleware('auth:api')->group(function () {
       Route::get('/logout', 'Api\AuthController@logout')->name('logout');
   });

   
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});