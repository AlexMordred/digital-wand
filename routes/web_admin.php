<?php

/**
 * Web маршруты для админов (только авторизированные пользователи)
 */

Route::get('/users', 'UsersController@index')->name('admin.users.index');
Route::post('/users', 'UsersController@store')->name('admin.users.store');
Route::get('/users/create', 'UsersController@create')->name('admin.users.create');

Route::get('/videos', 'VideosController@index')->name('admin.videos.index');
Route::post('/videos/{video}/reviewed', 'VideosController@setReviewed')->name('admin.videos.set-reviewed');
Route::delete('/videos/{video}', 'VideosController@destroy')->name('admin.videos.destroy');
