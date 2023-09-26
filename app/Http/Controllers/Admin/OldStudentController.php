<?php

namespace App\Http\Controllers\Admin;

use App\Models\OldStudent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class OldStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oldStudents = OldStudent::latest()->get();
        return view('admin.students-old.index', compact('oldStudents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students-old.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'student_type' => 'required|string',
            'title'       => 'required|string',
            'image'       => 'required|mimes:png,jpg,jpeg,webp|max:3024',
        ]);


        // get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)) {
            // make unique name for image
            $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('students/achievement')) {
                Storage::disk('public')->makeDirectory('students/achievement');
            }
            // resize image for post add upload
            $resizeImage = Image::make($image)->resize(360, 360)->stream();
            Storage::disk('public')->put('students/achievement/' . $imageName, $resizeImage);
        } else {
            $imageName = 'default.png';
        }

        $students = new OldStudent();
        $students->name = $request->name;
        $students->student_type = $request->student_type;
        $students->title = $request->title;
        $students->slug = $slug;
        $students->image  =  $imageName;

        if (isset($request->status)) {
            $students->status = true;
        } else {
            $students->status = false;
        }

        $students->save();
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
        $oldStudent = OldStudent::findOrFail($id);
        return view('admin.students-old.edit', compact('oldStudent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'student_type' => 'required|string',
            'title'       => 'required|string',
            'image'       => 'mimes:png,jpg,jpeg,webp|max:3024',
        ]);

        $students = OldStudent::findOrFail($id);
        // get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)) {
            // make unique name for image
            $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('students/achievement')) {
                Storage::disk('public')->makeDirectory('students/achievement');
            }
            //Old image delete in file
            if (Storage::disk('public')->exists('students/achievement/' . $students->image)) {
                Storage::disk('public')->delete('students/achievement/' . $students->image);
            }
            // resize image for post add upload
            $resizeImage = Image::make($image)->resize(360, 360)->stream();
            Storage::disk('public')->put('students/achievement/' . $imageName, $resizeImage);
        } else {
            $imageName =  $students->image;
        }

        $students->name = $request->name;
        $students->student_type = $request->student_type;
        $students->title = $request->title;
        $students->slug = $slug;
        $students->image  =  $imageName;

        if (isset($request->status)) {
            $students->status = true;
        } else {
            $students->status = false;
        }

        $students->update();
        Toastr::success('You have Update the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $students = OldStudent::findOrFail($id);
        //Old image delete in file
        if (Storage::disk('public')->exists('students/achievement/' . $students->image)) {
            Storage::disk('public')->delete('students/achievement/' . $students->image);
        }
        $students->delete();
        Toastr::success('You have Update the data Successfully', 'Success');
        return redirect()->back();
    }
}
