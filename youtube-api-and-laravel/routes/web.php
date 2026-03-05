<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\DemoController@index');
Route::get('/edit', 'App\Http\Controllers\DemoController@edit');
Route::get('/video-details', 'App\Http\Controllers\DemoController@videoDetails');
