<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$sliders = Slider::latest()->get();
		return view('admin.slider.index', compact('sliders'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.slider.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'				=> 'required|unique:sliders',
			// 'description'	=> 'required',
			'image'				=> 'required|image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		// return $request;

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('slider')) {
				Storage::disk('public')->makeDirectory('slider');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(1920, 884)->stream();
			Storage::disk('public')->put('slider/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		$slider = new Slider();

		$slider->title  = $request->title;
		// $slider->description  = $request->description;
		$slider->slug 	= $slug;
		$slider->image 	= $imageName;

		if (isset($request->status)) {
			$slider->status = true;
		} else {
			$slider->status = false;
		}

		$slider->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
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
	public function edit(string $id)
	{
		$sliders = Slider::findOrFail($id);
		return view('admin.slider.edit', compact('sliders'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'				=> 'required',
			'image'				=> 'image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		// return $request;

		$slider = Slider::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('slider')) {
				Storage::disk('public')->makeDirectory('slider');
			}
			//Old image delete in file
			if (Storage::disk('public')->exists('slider/' . $slider->image)) {
				Storage::disk('public')->delete('slider/' . $slider->image);
			}

			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(1920, 884)->stream();
			Storage::disk('public')->put('slider/' . $imageName, $resizeImage);
		} else {
			$imageName = $slider->image;
		}

		$slider->title  = $request->title;
		$slider->slug 	= $slug;
		$slider->image 	= $imageName;

		if (isset($request->status)) {
			$slider->status = true;
		} else {
			$slider->status = false;
		}

		$slider->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		Alert::success('Success', 'You have Update the data Successfully');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{

		$slider = Slider::findOrFail($id);

		//Delete image on file
		if (Storage::disk('public')->exists('slider/' . $slider->image)) {
			Storage::disk('public')->delete('slider/' . $slider->image);
		}

		$slider->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
