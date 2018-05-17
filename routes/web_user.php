<?php

/**
 * Web маршруты для пользователей (только авторизированные пользователи)
 */

Route::get('/videos', 'VideosController@index')->name('user.videos.index');
Route::get('/videos/create', 'VideosController@create')->name('user.videos.create');
Route::post('/videos', 'VideosController@store')->name('user.videos.store');
