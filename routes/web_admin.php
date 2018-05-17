<?php

/**
 * Web маршруты для админов (только авторизированные пользователи)
 */

Route::get('/users', 'UsersController@index')->name('admin.users.index');
Route::post('/users', 'UsersController@store')->name('admin.users.store');
Route::get('/users/create', 'UsersController@create')->name('admin.users.create');

Route::get('/videos', 'VideosController@index')->name('admin.videos.index');
