<?php

//// INDEX
Route::get('/roles', 'RoleController@index')->name('roles.index');

////STORE
Route::post('/roles', 'RoleController@store')->name('roles.store');

////DELETE
Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');


////EDIT
Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');

////UPDATE
Route::put('/roles/{role}/update', 'RoleController@update')->name('roles.update');
Route::put('/roles/{role}/attach', 'RoleController@attach_permission')->name('role.permission.attach');
Route::put('/roles/{role}/detach', 'RoleController@detach_permission')->name('role.permission.detach');
