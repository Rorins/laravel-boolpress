<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//HOME FRONT
Route::get('/', function () {
    return view('welcome');
});


//ROTTE PER AUTENTICAZIONE
Auth::routes();

//ROTTE AREA ADMIN
//dobbiamo puntare ad Admin/Homecontroller@index
// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth') //Rotte nel gruppo protette da auth(autenticazione)
->namespace('Admin') //aggiunta di Admin/Homecontroller@index
->name('admin.home')//nome della rotta
->prefix('admin')//prefisso per cui tutti gli url iniziano con /admin/
->group(function(){
    //ADMIN HOMEPAGE
    Route::get('/home', 'HomeController@index')->name('home');
});