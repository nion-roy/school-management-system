<?php

namespace App\Http\Controllers\Admin;

use App\Models\Speech;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speeches = Speech::get();
        return view('admin.about.speech.index', compact('speeches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.speech.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                => 'required|string',
            'title'                => 'required|string',
            'speech'               => 'required|string',
            'image'                => 'required|image|mimes:png,jpg,jpeg,webp|max:3072'
        ]);

        // return $request;

        // get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)) {
            // make unique name for image
            $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('about')) {
                Storage::disk('public')->makeDirectory('about');
            }
            // resize image for post add upload
            $resizeImage = Image::make($image)->resize(380, 380)->stream();
            Storage::disk('public')->put('about/' . $imageName, $resizeImage);
        } else {
            $imageName = 'default.png';
        }

        $speech = new Speech();
        $speech->name  = $request->name;
        $speech->title  = $request->title;
        $speech->slug     = $slug;
        $speech->speech  = $request->speech;
        $speech->speech_type  = $request->speech_type;
        $speech->image     = $imageName;

        if (isset($request->status)) {
            $speech->status = true;
        } else {
            $speech->status = false;
        }

        $speech->save();

        Toastr::success('You have Create the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $speech = Speech::findOrFail($id);
        return view('admin.about.speech.show', compact('speech'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $speech = Speech::findOrFail($id);
        return view('admin.about.speech.edit', compact('speech'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'                => 'required|string',
            'title'                => 'required|string',
            'speech'               => 'required|string',
            'image'                => 'image|mimes:png,jpg,jpeg,webp|max:3072'
        ]);

        // return $request;

        $speech = Speech::findOrFail($id);
        // get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)) {
            // make unique name for image
            $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('about')) {
                Storage::disk('public')->makeDirectory('about');
            }
            //Old image delete in file
            if (Storage::disk('public')->exists('about/' . $speech->image)) {
                Storage::disk('public')->delete('about/' . $speech->image);
            }

            // resize image for post add upload
            $resizeImage = Image::make($image)->resize(380, 380)->stream();
            Storage::disk('public')->put('about/' . $imageName, $resizeImage);
        } else {
            $imageName = $speech->image;
        }

        $speech->name  = $request->name;
        $speech->title  = $request->title;
        $speech->slug     = $slug;
        $speech->speech  = $request->speech;
        $speech->speech_type  = $request->speech_type;
        $speech->image     = $imageName;

        if (isset($request->status)) {
            $speech->status = true;
        } else {
            $speech->status = false;
        }

        $speech->save();

        Toastr::success('You have Create the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
