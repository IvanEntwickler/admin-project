<?php

use Illuminate\Support\Facades\Route;

/// SHOW
Route::get('/post/{post}', 'PostController@show')->name('post');

Route::middleware(['auth'])->group(function(){
/// INDEX
Route::get('/posts', 'PostController@index')->name('post.index');
/// CREATE
Route::get('/posts/create', 'PostController@create')->name('post.create');

/// STORE
Route::post('/posts', 'PostController@store')->name('post.store');


/// EDIT /// editing only possible for the owner
Route::get('/posts/{post}/edit', 'PostController@edit')->middleware('can:view, post')->name('post.edit');

/// UPDATE
Route::put('/posts/{post}/update', 'PostController@update')->name('post.update');

/// DELETE
Route::delete('/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');

});
