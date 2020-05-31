<?php
Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::group(['middleware'=>'auth'], function(){
    Route::get('/', function (){
        return view('index');
    })->name('home');
    Route::resource('/dreams', 'DreamsController')->except(['index', 'create']);
    Route::get('dreams/{dream}/toggle', 'DreamsController@toggle')->name('dreams.toggle');
    Route::get('dreams/{dream}/delete', 'DreamsController@destroy')->name('dreams.destroy');


    Route::get('/profile', 'UsersController@profile')->name('profile');

    Route::group(['middleware'=> ['role:admin']], function(){
        Route::resource('/users', 'UsersController');
    });

});




