<?php

//// INDEX
Route::get('/roles', 'RoleController@index')->name('roles.index');

////STORE
Route::post('/roles', 'RoleController@store')->name('roles.store');

////DELETE
Route::delete('/roles/{role}', 'RoleController@destroy')->name('roles.destroy');
