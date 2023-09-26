<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class VideoGalleryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$galleries = Gallery::where('gallery_type', 'video')->latest()->get();
		return view('admin.gallery.video.index', compact('galleries'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.gallery.video.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'    => 'required|string',
			'description' => 'required|string',
			'gallery'        => 'required|file|mimetypes:video/mp4|max:50240'
		]);

		// get form image
		$video = $request->file('gallery');
		$slug = Str::slug($request->title);


		if (isset($video)) {
			// make unique name for image
			$videoName = $slug . '-' . uniqid() . '.' . $video->getClientOriginalExtension();
			// check post dir is exists
			if (!Storage::disk('public')->exists('gallery/video')) {
				Storage::disk('public')->makeDirectory('gallery/video');
			}
			// video for add in exists
			$videoDir = file_get_contents($video);
			Storage::disk('public')->put('gallery/video/' . $videoName, $videoDir);
		} else {
			$videoName = 'default.mp4';
		}

		// return $request;

		$gallery = new Gallery();
		$gallery->title = $request->title;
		$gallery->slug = $slug;
		$gallery->description = $request->description;
		$gallery->gallery = $videoName;

		$gallery->gallery_type = 'video';

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
		return view('admin.gallery.video.show', compact('galleries'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$galleries = Gallery::findOrFail($id);
		return view('admin.gallery.video.edit', compact('galleries'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'    => 'required|string',
			'description' => 'required|string',
			'gallery'        => 'file|mimetypes:video/mp4|max:50240'
		]);

		$gallery = Gallery::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);

		// return $request;

		$gallery->title = $request->title;
		$gallery->slug = $slug;
		$gallery->description = $request->description;

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
