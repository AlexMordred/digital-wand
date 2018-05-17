<?php

/**
 * Web маршруты для админов (только авторизированные пользователи)
 */

 Route::post('/users', 'UsersController@store')->name('admin.users.store');
