<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'teacher.', 'prefix' => 'teacher', 'middleware' => 'teacher'], function () {
	Route::get('profile', [App\Http\Controllers\Teacher\ProfileController::class, 'profile'])->name('profile');
	Route::post('teacher-profile-update', [App\Http\Controllers\Teacher\ProfileController::class, 'updateProfile'])->name('updateProfile');
	Route::post('teacher-password-change', [App\Http\Controllers\Teacher\ProfileController::class, 'updatePassword'])->name('updatePassword');

	Route::get('destroy', [App\Http\Controllers\Teacher\TeacherController::class, 'destroy'])->name('destroy');

	//student result add route
	Route::resource('result', App\Http\Controllers\Teacher\ResultController::class);
	Route::get('result/{id}/delete', [App\Http\Controllers\Teacher\ResultController::class, 'destroy'])->name('result.delete');
	Route::get('roll/{id}', [App\Http\Controllers\Teacher\ResultController::class, 'getRolls']);
	Route::get('information/{id}', [App\Http\Controllers\Teacher\ResultController::class, 'getInformation']);
});
