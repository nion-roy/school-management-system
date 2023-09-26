<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::where('gallery_type', 'image')->latest()->get();
        return view('admin.gallery.image.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => 'required|string',
            'description' => 'required|string',
            'gallery'        => 'required|mimes:png,jpg,jpeg,webp'
        ]);

        // get form image
        $image = $request->file('gallery');
        $slug = Str::slug($request->title);

        if (isset($image)) {
            // make unique name for image
            $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('gallery/image')) {
                Storage::disk('public')->makeDirectory('gallery/image');
            }

            // resize image for post add upload
            $resizeImage = Image::make($image)->resize(640, 480)->stream();
            Storage::disk('public')->put('gallery/image/' . $imageName, $resizeImage);
        } else {
            $imageName = 'default.png';
        }


        // return $request;

        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->slug = $slug;
        $gallery->description = $request->description;
        $gallery->gallery    = $imageName;

        $gallery->gallery_type    = 'image';

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
        return view('admin.gallery.image.show', compact('galleries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galleries = Gallery::findOrFail($id);
        return view('admin.gallery.image.edit', compact('galleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title'    => 'required|string',
            'description' => 'required|string',
            'gallery'        => 'mimes:png,jpg,jpeg,webp'
        ]);

        $gallery = Gallery::findOrFail($id);

        // get form image
        $image = $request->file('gallery');
        $slug = Str::slug($request->title);

        if (isset($image)) {
            // make unique name for image
            $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('gallery/image')) {
                Storage::disk('public')->makeDirectory('gallery/image');
            }
            // delete old image
            if (!Storage::disk('public')->exists('gallery/image/' . $gallery->gallery)) {
                Storage::disk('public')->delete('gallery/image/' . $gallery->gallery);
            }

            // resize image for post add upload
            $resizeImage = Image::make($image)->resize(640, 480)->stream();
            Storage::disk('public')->put('gallery/image/' . $imageName, $resizeImage);
        } else {
            $imageName = $gallery->gallery;
        }


        // return $request;

        $gallery->title = $request->title;
        $gallery->slug = $slug;
        $gallery->description = $request->description;
        $gallery->gallery    = $imageName;

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
        if (!Storage::disk('public')->exists('gallery/image/' . $gallery->image)) {
            Storage::disk('public')->delete('gallery/image/' . $gallery->image);
        }

        $gallery->delete();

        Toastr::success('You have Delete the data Successfully', 'Success');
        return redirect()->back();
    }
}
