<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Facts;
use App\Models\Notice;
use App\Models\Slider;
use App\Models\Speech;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Chairman;
use App\Models\Admission;
use App\Models\TeacherTab;
use App\Models\UpdateNews;
use App\Models\ImportantNews;
use App\Models\AdmissionDetails;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Paginator::useBootstrap();

		view()->composer('*', function ($view) {
			$view->with('f_sliders', Slider::where('status', true)->latest()->get());
			$view->with('f_facts', Facts::latest()->get());
			$view->with('f_about', About::where('status', true)->get()->first());
			$view->with('f_chairman', Chairman::where('status', true)->get()->first());
			// $view->with('f_admission', Admission::where('status', true)->latest()->get());
			// $view->with('f_department', AdmissionDetails::where('status', true)->latest()->get());
			// $view->with('f_payment', Payment::where('status', true)->get());
			$view->with('f_settings', Setting::get()->first());
			$view->with('f_speeches', Speech::where('status', true)->latest()->get());
			$view->with('f_notice', Notice::where('status', true)->latest()->get());
			$view->with('f_udpdateNews', UpdateNews::where('status', true)->latest()->get());
			$view->with('f_inportantNews', ImportantNews::where('status', true)->latest()->get());
			// $view->with('f_teacherType', TeacherTab::latest()->get());
		});
	}
}
