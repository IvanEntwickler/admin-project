<?php

use Illuminate\Support\Facades\Route;

/// UPDATE
Route::put('/users/{user}/update', 'UserController@update')->name('user.profile.update');


/// DELETE
Route::delete('/users/{user}/destroy', 'UserController@destroy')->name('users.destroy');

/// MIDDLEWARE

/// only Admin-Users can see the all the Users in a List
Route::middleware(['role:admin', 'auth'])->group(function(){
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::put('/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('/users/{user}/detach', 'UserController@detach')->name('user.role.detach');
});

// Admin Users can see all user profiles and normal users only there own
Route::middleware(['can:view,user'])->group(function(){
    Route::get('/users/{user}/profile', 'UserController@show')->name('user.profile.show');
});
