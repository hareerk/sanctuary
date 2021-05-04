<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('animals',AnimalController::class);

Route::post('request', 'App\Http\Controllers\AdoptionController@store')->name('request');
Route::get('adoptions', 'App\Http\Controllers\AdoptionController@list')->name('adoptions');
Route::get('/approve/{adoption}', 'App\Http\Controllers\AdoptionController@approve')->name('approve');
Route::get('/deny/{adoption}', 'App\Http\Controllers\AdoptionController@deny')->name('deny');
