<?php

Route::resource('/', 'DreamsController')->middleware('auth');
Route::get('/update/{id}', 'DreamsController@update')->middleware('auth');
Route::get('/destroy/{id}', 'DreamsController@destroy')->middleware('auth');

Route::get('/stats', 'DreamsController@stats')->middleware('auth');

Auth::routes();

