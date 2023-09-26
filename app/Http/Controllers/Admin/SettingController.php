<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$settings = Setting::get()->first();
		return view('admin.setting.index', compact('settings'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function setting(string $id)
	{
		$settings = Setting::findOrFail($id);
		return view('admin.setting.index', compact('settings'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'wb_name'		=> 'required',
			'wb_logo'		=> 'mimes:png,jpg,jpeg|image',
			'wb_favicon'	=> 'mimes:png,jpg|image',
		]);

		$settings = Setting::findOrFail($id);
		// get form image
		$logo = $request->file('wb_logo');
		$slug = Str::slug($request->wb_name);
		if (isset($logo)) {
			// make unique name for image
			$imageLogo = $slug . '-' . uniqid() . '.' . $logo->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('setting')) {
				Storage::disk('public')->makeDirectory('setting');
			}
			// check old image & delete is exists
			if (Storage::disk('public')->exists('setting/' . $settings->wb_logo)) {
				Storage::disk('public')->delete('setting/' . $settings->wb_logo);
			}
			// resize image for post add upload
			$resizeImage = Image::make($logo)->resize(80, 80)->stream();
			Storage::disk('public')->put('setting/' . $imageLogo, $resizeImage);
		} else {
			$imageLogo = $settings->wb_logo;
		}

		// get form image
		$favicon = $request->file('wb_favicon');
		$slug = Str::slug($request->wb_name);
		if (isset($favicon)) {
			// make unique name for image
			$imageFavicon = $slug . '-' . uniqid() . '.' . $favicon->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('setting')) {
				Storage::disk('public')->makeDirectory('setting');
			}
			// check old image & delete is exists
			if (Storage::disk('public')->exists('setting/' . $settings->wb_favicon)) {
				Storage::disk('public')->delete('setting/' . $settings->wb_favicon);
			}
			// resize image for post add upload
			$resizeImage = Image::make($favicon)->resize(32, 32)->stream();
			Storage::disk('public')->put('setting/' . $imageFavicon, $resizeImage);
		} else {
			$imageFavicon = $settings->wb_favicon;
		}

		// get form image
		$banner = $request->file('banner');
		$slug = Str::slug($request->wb_name);
		if (isset($banner)) {
			// make unique name for image
			$imageBanner = $slug . '-' . uniqid() . '.' . $banner->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('setting')) {
				Storage::disk('public')->makeDirectory('setting');
			}
			// check old image & delete is exists
			if (Storage::disk('public')->exists('setting/' . $settings->banner)) {
				Storage::disk('public')->delete('setting/' . $settings->banner);
			}
			// resize image for post add upload
			$resizeImage = Image::make($banner)->resize(1920, 1080)->stream();
			Storage::disk('public')->put('setting/' . $imageBanner, $resizeImage);
		} else {
			$imageBanner = $settings->banner;
		}

		$settings->wb_name 	= $request->wb_name;
		$settings->wb_logo	= $imageLogo;
		$settings->wb_favicon = $imageFavicon;
		$settings->number_1 = $request->number_1;
		$settings->number_2 = $request->number_2;
		$settings->number_3 = $request->number_3;
		$settings->facebook = $request->facebook;
		$settings->twiter = $request->twiter;
		$settings->linkedin = $request->linkedin;
		$settings->instagram = $request->instagram;
		$settings->email = $request->email;
		$settings->address = $request->address;
		$settings->iframe = $request->iframe;
		$settings->banner = $imageBanner;

		$settings->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}
}
