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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'TasksController@index')->name('task');

Route::get('/tasks', 'TasksController@index')->name('task');    //轉址
Route::get('/tasks', 'TasksController@index')->name('tasks');   //轉址

Route::post('tasks', 'TasksController@store');                  // 添加事項
Route::patch('tasks/{task}', 'TasksController@update');         // 完成事項
Route::delete('tasks/{task}', 'TasksController@destroy');       // 刪除事項
