<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$partners = Partner::latest()->get();
		return view('admin.partner.index', compact('partners'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.partner.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'				=> 'required|string',
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
			if (!Storage::disk('public')->exists('partner')) {
				Storage::disk('public')->makeDirectory('partner');
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(260, 260)->stream();
			Storage::disk('public')->put('partner/' . $imageName, $resizeImage);
		} else {
			$imageName = 'default.png';
		}

		$partner = new Partner();

		$partner->name  = $request->name;
		$partner->image 	= $imageName;

		if (isset($request->status)) {
			$partner->status = true;
		} else {
			$partner->status = false;
		}

		$partner->save();

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
		$partners = Partner::findOrFail($id);
		return view('admin.partner.edit', compact('partners'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'name'				=> 'required|string',
			'image'				=> 'image|mimes:png,jpg,jpeg,webp|max:3072'
		]);

		// return $request;

		$partner = Partner::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->name);

		if (isset($image)) {
			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('partner')) {
				Storage::disk('public')->makeDirectory('partner');
			}
			//Old image delete in file
			if (Storage::disk('public')->exists('partner/' . $partner->image)) {
				Storage::disk('public')->delete('partner/' . $partner->image);
			}
			// resize image for post add upload
			$resizeImage = Image::make($image)->resize(260, 260)->stream();
			Storage::disk('public')->put('partner/' . $imageName, $resizeImage);
		} else {
			$imageName = $partner->image;
		}

		$partner->name  = $request->name;
		$partner->image 	= $imageName;

		if (isset($request->status)) {
			$partner->status = true;
		} else {
			$partner->status = false;
		}

		$partner->update();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$partner = Partner::findOrFail($id);
		//Old image delete in file
		if (Storage::disk('public')->exists('partner/' . $partner->image)) {
			Storage::disk('public')->delete('partner/' . $partner->image);
		}
		$partner->delete();

		Toastr::success('You have Update the data Successfully', 'Success');
		return redirect()->back();
	}
}
