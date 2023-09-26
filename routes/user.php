<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => 'user'], function () {
	Route::get('dashboard', [App\Http\Controllers\User\UserController::class, 'index'])->name('dashboard');
});
