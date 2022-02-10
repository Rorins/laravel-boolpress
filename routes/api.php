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

//URL iniziano con slash API

Route::get('/test', function(){

    //Return JSON DATA
    return response()->json([
        'clients' => ['Paolo','Giorgio','Marta'],
        'lorem' => 'ipsum'
    ]);
});

//ENDPOINT API
Route::namespace('Api')->group(function(){
    //POST ARCHIVE
    Route::get('/posts','PostController@index');

    //single post detail
    Route::get('/posts/{slug}','PostController@show');
});