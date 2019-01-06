<?php

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

// Route::get('/', function () {
//     return view('top');
// });

Route::resource('users', 'UserController');
Route::resource('lessons', 'LessonController');
Route::get('expenses/{id}/receipt', 'ExpenseController@receipt');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
