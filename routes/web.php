<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('speech/{slug}', [App\Http\Controllers\SpeechController::class, 'speech'])->name('speech');
Route::get('announcement/{slug}', [App\Http\Controllers\AnnouncementController::class, 'announcement'])->name('announcement');
Route::get('all-notice/', [App\Http\Controllers\NoticeController::class, 'notice'])->name('all-notice');
Route::get('notice/{slug}', [App\Http\Controllers\NoticeController::class, 'noticeDetails'])->name('notice.details');
Route::get('about-us', [App\Http\Controllers\AboutController::class, 'about'])->name('about');
Route::get('teachers/{id}', [App\Http\Controllers\TeacherController::class, 'allTeachers'])->name('all.teachers');
Route::get('results', [App\Http\Controllers\ResultController::class, 'result'])->name('result');
Route::get('results/{id}/download', [App\Http\Controllers\ResultController::class, 'download'])->name('result/download');
Route::get('class-routines', [App\Http\Controllers\ClassRoutineController::class, 'classRoutine'])->name('class-routines');
Route::get('class-routines/{id}/download', [App\Http\Controllers\ClassRoutineController::class, 'download'])->name('class-routines/download');
Route::get('exam-routines', [App\Http\Controllers\ExamRoutineController::class, 'examRoutine'])->name('exam-routines');
Route::get('exam-routines/{id}/download', [App\Http\Controllers\ExamRoutineController::class, 'download'])->name('exam-routines/download');

// Route::get('admission/{slug}', [App\Http\Controllers\AdmissionController::class, 'admission'])->name('admission');
Route::get('admission/{slug}', [App\Http\Controllers\AdmissionController::class, 'index'])->name('admission');
Route::get('admission/{id}/details', [App\Http\Controllers\AdmissionController::class, 'show'])->name('admission.details');

Route::get('online-admission', [App\Http\Controllers\OnlineAdmission::class, 'admission'])->name('online-admission');
Route::get('student', [App\Http\Controllers\StudentController::class, 'student'])->name('student');

Route::get('image-gallery', [App\Http\Controllers\ImageGalleryController::class, 'imageGallery'])->name('image-gallery');
Route::get('details/{slug}', [App\Http\Controllers\ImageGalleryController::class, 'imageGalleryDetails'])->name('image-details');
Route::get('video-gallery', [App\Http\Controllers\VideoGalleryController::class, 'videoGallery'])->name('video-gallery');

Route::get('news', [App\Http\Controllers\NewsController::class, 'news'])->name('news');
Route::get('news-details/{slug}', [App\Http\Controllers\NewsController::class, 'newsDetails'])->name('news-details');
Route::resource('contact-us', App\Http\Controllers\ContactController::class);

Route::post('online-admission', [App\Http\Controllers\OnlineAdmission::class, 'store'])->name('online-admission.store');

Route::get('student-results', [App\Http\Controllers\StudentResultController::class, 'index'])->name('student-results');
Route::get('student-results/{id}', [App\Http\Controllers\StudentResultController::class, 'studentRoll'])->name('student-results-roll');
Route::get('student-class-result/{id}', [App\Http\Controllers\StudentResultController::class, 'studentResults'])->name('student-class-result');


require __DIR__ . '/admin.php';
require __DIR__ . '/teacher.php';
require __DIR__ . '/user.php';
