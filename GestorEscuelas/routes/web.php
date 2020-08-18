<?php

use Illuminate\Support\Facades\Route;

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
Route::post('login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

Route::get('/', 'Auth\LoginController@showLoginForm')->middleware('guest');
Route::get('login', 'Auth\LoginController@showLoginForm')->middleware('guest');

Route::get('dashboard','DashboardController@index')->name('dashboard');

Route::resource('escuelas', 'EscuelaController');   
Route::resource('alumnos', 'AlumnoController');   
