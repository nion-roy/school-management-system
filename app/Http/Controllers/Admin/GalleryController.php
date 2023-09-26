<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GalleryFilter;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$galleries = Gallery::latest()->get();
		return view('admin.gallery.index', compact('galleries'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.gallery.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'	=> 'required|string',
			'description' => 'required|string',
			'image'		=> 'file|mimes:png,jpg,jpeg,webp'
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('gallery')) {
				Storage::disk('public')->makeDirectory('gallery');
			}

			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(640, 480)->stream();
			Storage::disk('public')->put('gallery/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}


		// return $request;

		$gallery = new Gallery();
		$gallery->gallery_type = $request->gallery_type;
		$gallery->title = $request->title;
		$gallery->slug = $slug;
		$gallery->description = $request->description;
		$gallery->image	= $imageName;

		if (isset($request->status)) {
			$gallery->status = true;
		} else {
			$gallery->status = false;
		}

		$gallery->save();


		Toastr::success('You have Create the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$galleries = Gallery::findOrFail($id);
		return view('admin.gallery.show', compact('galleries'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$galleries = Gallery::findOrFail($id);
		return view('admin.gallery.edit', compact('galleries'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'	=> 'required|string',
			'description' => 'required|string'
		]);

		$gallery = Gallery::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('gallery')) {
				Storage::disk('public')->makeDirectory('gallery');
			}
			// delete old image
			if (!Storage::disk('public')->exists('gallery/' . $gallery->image)) {
				Storage::disk('public')->delete('gallery/' . $gallery->image);
			}

			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(640, 480)->stream();
			Storage::disk('public')->put('gallery/' . $imageName, $resizeImage);
		} else {
			$imageName = $gallery->image;
		}


		// return $request;

		$gallery->title = $request->title;
		$gallery->slug = $slug;
		$gallery->description = $request->description;
		$gallery->image	= $imageName;

		if (isset($request->status)) {
			$gallery->status = true;
		} else {
			$gallery->status = false;
		}

		$gallery->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$gallery = Gallery::findOrFail($id);

		// delete old image
		if (!Storage::disk('public')->exists('gallery/' . $gallery->image)) {
			Storage::disk('public')->delete('gallery/' . $gallery->image);
		}

		$gallery->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
