<?php

/**
 * Web маршруты, доступные всем публично
 */

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Dashboards
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', 'Web\Admin\DashboardController@index')->name('admin.index');
    Route::get('/user', 'Web\User\DashboardController@index')->name('user.index');
});
