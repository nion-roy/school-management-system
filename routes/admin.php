<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudentResultController;

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
	Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('login');
	Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login']);
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
	Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
	Route::get('destroy', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('destroy');
	Route::resource('slider', App\Http\Controllers\Admin\SliderController::class);
	Route::get('slider/{id}/delete', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('slider.delete');
	//about route
	Route::resource('about', App\Http\Controllers\Admin\AboutController::class);
	Route::get('about/{id}/delete', [App\Http\Controllers\Admin\AboutController::class, 'destroy'])->name('about.delete');
	//speech route
	Route::resource('speech', App\Http\Controllers\Admin\SpeechController::class);
	Route::get('speech/{id}/delete', [App\Http\Controllers\Admin\SpeechController::class, 'destroy'])->name('speech.delete');
	//chairman route
	Route::resource('chairman', App\Http\Controllers\Admin\ChairmanController::class);
	Route::get('chairman/{id}/delete', [App\Http\Controllers\Admin\ChairmanController::class, 'destroy'])->name('chairman.delete');
	//mission route
	Route::resource('mission', App\Http\Controllers\Admin\MissionController::class);
	Route::get('mission/{id}/delete', [App\Http\Controllers\Admin\MissionController::class, 'destroy'])->name('mission.delete');
	//vision route
	Route::resource('vision', App\Http\Controllers\Admin\VisionController::class);
	Route::get('vision/{id}/delete', [App\Http\Controllers\Admin\VisionController::class, 'destroy'])->name('vision.delete');
	//teacher route
	Route::resource('teacher', App\Http\Controllers\Admin\TeacherController::class);
	Route::get('teacher/{id}/delete', [App\Http\Controllers\Admin\TeacherController::class, 'destroy'])->name('teacher.delete');
	//teacher route
	Route::resource('information-front-teacher', App\Http\Controllers\Admin\TeacherTabController::class);
	Route::get('information-front-teacher/{id}/delete', [App\Http\Controllers\Admin\TeacherTabController::class, 'destroy'])->name('front-teacher.delete');
	//exam result route
	Route::resource('result', App\Http\Controllers\Admin\ResultController::class);
	Route::get('result/{id}/delete', [App\Http\Controllers\Admin\ResultController::class, 'destroy'])->name('result.delete');
	Route::get('result/{id}/download', [App\Http\Controllers\Admin\ResultController::class, 'download'])->name('result.download');
	//exam routine route
	Route::resource('exam-routine', App\Http\Controllers\Admin\ExamController::class);
	Route::get('exam-routine/{id}/download', [App\Http\Controllers\Admin\ExamController::class, 'download'])->name('exam-routine.download');
	Route::get('exam-routine/{id}/delete', [App\Http\Controllers\Admin\ExamController::class, 'destroy'])->name('exam-routine.delete');
	//class routine route
	Route::resource('class-routine', App\Http\Controllers\Admin\ClassRoutineController::class);
	Route::get('class-routine/{id}/download', [App\Http\Controllers\Admin\ClassRoutineController::class, 'download'])->name('class-routine.download');
	Route::get('class-routine/{id}/delete', [App\Http\Controllers\Admin\ClassRoutineController::class, 'destroy'])->name('class-routine.delete');
	//notice route
	Route::resource('notice', App\Http\Controllers\Admin\NoticeController::class);
	Route::get('notice/{id}/download', [App\Http\Controllers\Admin\NoticeController::class, 'download'])->name('notice.download');
	Route::get('notice/{id}/delete', [App\Http\Controllers\Admin\NoticeController::class, 'destroy'])->name('notice.delete');
	//notice route
	Route::resource('announcement', App\Http\Controllers\Admin\AnnouncementController::class);
	Route::get('announcement/{id}/download', [App\Http\Controllers\Admin\AnnouncementController::class, 'download'])->name('announcement.download');
	Route::get('announcement/{id}/delete', [App\Http\Controllers\Admin\AnnouncementController::class, 'destroy'])->name('announcement.delete');
	//admission route
	Route::resource('admission', App\Http\Controllers\Admin\AdmissionController::class);
	Route::get('admission/{id}/delete', [App\Http\Controllers\Admin\AdmissionController::class, 'destroy'])->name('admission.delete');
	//admission details route
	Route::resource('admission-details', App\Http\Controllers\Admin\AdmissionDetailsController::class);
	Route::get('admission-details/{id}/delete', [App\Http\Controllers\Admin\AdmissionDetailsController::class, 'destroy'])->name('admission-details.delete');
	//admission semester route
	Route::resource('admission-semester', App\Http\Controllers\Admin\AdmissionSemesterController::class);
	Route::get('admission-semester/{id}/delete', [App\Http\Controllers\Admin\AdmissionSemesterController::class, 'destroy'])->name('admission-semester.delete');
	//admission semester details route
	Route::resource('admission-semester-details', App\Http\Controllers\Admin\AdmissionSemesterDetailsController::class);
	Route::get('admission-semester-details/{id}/delete', [App\Http\Controllers\Admin\AdmissionSemesterDetailsController::class, 'destroy'])->name('admission-semester-details.delete');


	//academic type route
	Route::get('type-of-academic', [App\Http\Controllers\Admin\AcademicTypeController::class, 'typeAcademic'])->name('type-of-academic.index');
	Route::post('type-of-academic', [App\Http\Controllers\Admin\AcademicTypeController::class, 'store'])->name('type-of-academic.store');
	Route::get('type-of-academic/{id}/delete', [App\Http\Controllers\Admin\AcademicTypeController::class, 'destroy'])->name('type-of-academic.delete');

	//academic information route
	Route::resource('academic-information', App\Http\Controllers\Admin\AcademicController::class);
	Route::get('academic-information/{id}/delete', [App\Http\Controllers\Admin\AcademicController::class, 'destroy'])->name('academic-information.delete');


	//gallery route
	// Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class);
	// Route::get('gallery/{id}/delete', [App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('gallery.delete');
	//image gallery route
	Route::resource('image-gallery', App\Http\Controllers\Admin\ImageGalleryController::class);
	Route::get('image-gallery/{id}/delete', [App\Http\Controllers\Admin\ImageGalleryController::class, 'destroy'])->name('image-gallery.delete');
	//video gallery route
	Route::resource('video-gallery', App\Http\Controllers\Admin\VideoGalleryController::class);
	Route::get('video-gallery/{id}/delete', [App\Http\Controllers\Admin\VideoGalleryController::class, 'destroy'])->name('video-gallery.delete');
	//news route
	Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
	Route::get('news/{id}/delete', [App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('news.delete');

	//student route
	Route::resource('all-student', App\Http\Controllers\Admin\StudentController::class);
	Route::get('all-student/{id}/delete', [App\Http\Controllers\Admin\StudentController::class, 'destroy'])->name('all-student.delete');
	//old student route
	Route::resource('achievement-student', App\Http\Controllers\Admin\OldStudentController::class);
	Route::get('achievement-student/{id}/delete', [App\Http\Controllers\Admin\OldStudentController::class, 'destroy'])->name('achievement-student.delete');
	//student results route
	Route::resource('student-result', App\Http\Controllers\Admin\StudentResultController::class);
	Route::get('student-result/{id}/delete', [App\Http\Controllers\Admin\StudentResultController::class, 'destroy'])->name('student-result.delete');
	Route::get('student-roll/{id}', [App\Http\Controllers\Admin\StudentResultController::class, 'getRolls']);
	Route::get('student-information/{id}', [App\Http\Controllers\Admin\StudentResultController::class, 'getInformation']);



	//student admission route
	Route::resource('student-addmission', App\Http\Controllers\Admin\StudentAdmissionController::class);
	Route::get('student-addmission/{id}/delete', [App\Http\Controllers\Admin\StudentAdmissionController::class, 'destroy'])->name('student-addmission.delete');
	Route::get('pending-admission/{id}', [App\Http\Controllers\Admin\StudentAdmissionController::class, 'isApproved'])->name('pending-admission');
	//student admission online route
	Route::resource('online-student-addmission', App\Http\Controllers\Admin\OnlineAdmissionController::class);
	Route::get('online-student-addmission/{id}/delete', [App\Http\Controllers\Admin\OnlineAdmissionController::class, 'destroy'])->name('online-student-addmission.delete');
	//facts route
	Route::resource('facts', App\Http\Controllers\Admin\FactsController::class);
	Route::get('facts/{id}/delete', [App\Http\Controllers\Admin\FactsController::class, 'destroy'])->name('facts.delete');
	//partner route
	Route::resource('partner', App\Http\Controllers\Admin\PartnerController::class);
	Route::get('partner/{id}/delete', [App\Http\Controllers\Admin\PartnerController::class, 'destroy'])->name('partner.delete');
	//testimonial route
	Route::resource('testimonial', App\Http\Controllers\Admin\TestimonialController::class);
	Route::get('testimonial/{id}/delete', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('testimonial.delete');
	//payment route
	Route::resource('payment', App\Http\Controllers\Admin\PaymentController::class);
	Route::get('payment/{id}/delete', [App\Http\Controllers\Admin\PaymentController::class, 'destroy'])->name('payment.delete');


	//important news route
	Route::resource('important-news', App\Http\Controllers\Admin\ImportantNewsController::class);
	Route::get('important-news/{id}/delete', [App\Http\Controllers\Admin\ImportantNewsController::class, 'destroy'])->name('important-news.delete');

	//update news route
	Route::resource('update-news', App\Http\Controllers\Admin\UpdateNewsController::class);
	Route::get('update-news/{id}/delete', [App\Http\Controllers\Admin\UpdateNewsController::class, 'destroy'])->name('update-news.delete');


	Route::resource('user', App\Http\Controllers\Admin\UserController::class);
	Route::get('user/{id}/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.delete');
	Route::get('users/teachers', [App\Http\Controllers\Admin\UserController::class, 'teachers'])->name('user.teacher');
	Route::get('users/students', [App\Http\Controllers\Admin\UserController::class, 'students'])->name('user.student');
	Route::get('users/students/{id}/details', [App\Http\Controllers\Admin\UserController::class, 'studentDetails'])->name('user.student.show');


	//section route
	Route::resource('section', App\Http\Controllers\Admin\SectionController::class);
	Route::get('section/{id}/delete', [App\Http\Controllers\Admin\SectionController::class, 'destroy'])->name('section.delete');

	//class route
	Route::resource('class', App\Http\Controllers\Admin\BatchController::class);
	Route::get('class/{id}/delete', [App\Http\Controllers\Admin\BatchController::class, 'destroy'])->name('class.delete');

	//subject route
	Route::resource('subject', App\Http\Controllers\Admin\SubjectController::class);
	Route::get('subject/{id}/delete', [App\Http\Controllers\Admin\SubjectController::class, 'destroy'])->name('subject.delete');

	//teacher-assign route
	Route::get('teacher-assign', [App\Http\Controllers\Admin\TeacherAssignController::class, 'index'])->name('teacher-assign.index');
	Route::post('teacher-assign/store', [App\Http\Controllers\Admin\TeacherAssignController::class, 'store'])->name('teacher-assign.store');
	Route::get('teacher-assign/{id}/delete', [App\Http\Controllers\Admin\TeacherAssignController::class, 'destroy'])->name('teacher-assign.delete');

	//website setting route
	Route::resource('settings', App\Http\Controllers\Admin\SettingController::class);
});
