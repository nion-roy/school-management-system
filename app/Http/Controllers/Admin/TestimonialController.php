<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$testimonials = Testimonial::latest()->get();
		return view('admin.testimonial.index', compact('testimonials'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.testimonial.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'				=> 'required|string',
			'designation'	=> 'required|string',
			'location'	=> 'required|string',
			'comment'			=> 'required|string',
			'image'				=> 'required|image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		// return $request;

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('testimonial')) {
				Storage::disk('public')->makeDirectory('testimonial');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(260, 260)->stream();
			Storage::disk('public')->put('testimonial/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		$testimonial = new Testimonial();

		$testimonial->name  = $request->name;
		$testimonial->designation  = $request->designation;
		$testimonial->location  = $request->location;
		$testimonial->comment  = $request->comment;
		$testimonial->image 	= $imageName;

		if (isset($request->status)) {
			$testimonial->status = true;
		} else {
			$testimonial->status = false;
		}

		$testimonial->save();

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
		$testimonial = Testimonial::findOrFail($id);
		return view('admin.testimonial.edit', compact('testimonial'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{

		$this->validate($request, [
			'name'				=> 'required|string',
			'designation'	=> 'required|string',
			'location'		=> 'required|string',
			'comment'			=> 'required|string',
			'image'				=> 'image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		// return $request;

		$testimonial = Testimonial::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('testimonial')) {
				Storage::disk('public')->makeDirectory('testimonial');
			}
			//Old image delete in file
			if (Storage::disk('public')->exists('testimonial/' . $testimonial->image)) {
				Storage::disk('public')->delete('testimonial/' . $testimonial->image);
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(280, 280)->stream();
			Storage::disk('public')->put('testimonial/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		$testimonial->name  = $request->name;
		$testimonial->designation  = $request->designation;
		$testimonial->location  = $request->location;
		$testimonial->comment  = $request->comment;
		$testimonial->image 	= $imageName;

		if (isset($request->status)) {
			$testimonial->status = true;
		} else {
			$testimonial->status = false;
		}

		$testimonial->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$testimonial = Testimonial::findOrFail($id);
		//Old image delete in file
		if (Storage::disk('public')->exists('testimonial/' . $testimonial->image)) {
			Storage::disk('public')->delete('testimonial/' . $testimonial->image);
		}
		$testimonial->delete();

		Toastr::success('You have Delete the data Successfully', 'Success');
		return redirect()->back();
	}
}
