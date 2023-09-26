<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$about = About::latest()->get();
		return view('admin.about.index', compact('about'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.about.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'		=> 'required|string|unique:abouts',
			'description'		=> 'required|string',
			'image'		=> 'required|image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('about')) {
				Storage::disk('public')->makeDirectory('about');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(600, 600)->stream();
			Storage::disk('public')->put('about/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		$about = new About();
		$about->title 		=	$request->title;
		$about->description 		=	$request->description;
		$about->image 		=	$imageName;
		$about->slug 		=	$slug;

		if (isset($request->status)) {
			$about->status = true;
		} else {
			$about->status = false;
		}

		$about->save();

		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$auth = Auth::user();
		$about = About::findOrFail($id);
		return view('admin.about.show', compact('about', 'auth'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$about = About::findOrFail($id);
		return view('admin.about.edit', compact('about'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'		=> 'required|string',
			'description'		=> 'required|string',
			'image'		=> 'image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		$about = About::findOrFail($id);
		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('about')) {
				Storage::disk('public')->makeDirectory('about');
			}

			// check old image & delete is exists
			if (Storage::disk('public')->exists('about/' . $about->image)) {
				Storage::disk('public')->delete('about/' . $about->image);
			}

			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(600, 600)->stream();
			Storage::disk('public')->put('about/' . $imageName, $resizeImage);
		} else {
			$imageName = $about->image;
		}

		$about->title 		=	$request->title;
		$about->description 		=	$request->description;
		$about->image 		=	$imageName;
		$about->slug 		=	$slug;

		if (isset($request->status)) {
			$about->status = true;
		} else {
			$about->status = false;
		}

		$about->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$about = About::findOrFail($id);

		// check old image & delete is exists
		if (Storage::disk('public')->exists('about/' . $about->image)) {
			Storage::disk('public')->delete('about/' . $about->image);
		}

		$about->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
