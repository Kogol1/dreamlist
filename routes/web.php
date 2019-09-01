<?php

Route::resource('/', 'DreamsController')->middleware('auth');
Route::get('/update/{id}', 'DreamsController@update')->middleware('auth');
Route::get('/destroy/{id}', 'DreamsController@destroy')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
