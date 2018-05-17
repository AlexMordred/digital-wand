<?php

/**
 * Web маршруты для пользователей (только авторизированные пользователи)
 */

 Route::post('/videos', 'VideosController@store')->name('user.videos.store');
