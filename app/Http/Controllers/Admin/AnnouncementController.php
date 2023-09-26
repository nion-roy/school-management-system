<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcement.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'                    => 'required|string',
            'pdf'                        => 'required|mimes:pdf',
        ]);


        $pdfFile = $request->file('pdf');
        $slug = Str::slug($request->title);
        $currentData = Carbon::now()->toDateString();

        if (isset($pdfFile)) {
            $pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('announcement')) {
                Storage::disk('public')->makeDirectory('announcement');
            }
            // pdf for add in exists
            $pdfData = file_get_contents($pdfFile);
            Storage::disk('public')->put('announcement/' . $pdfName, $pdfData);
        } else {
            $pdfName = 'default.pdf';
        }


        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->slug = $slug;
        $announcement->pdf = $pdfName;
        if (isset($request->status)) {
            $announcement->status = true;
        } else {
            $announcement->status = false;
        }

        $announcement->save();

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
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcement.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title'     => 'required|string',
            'pdf'    => 'mimes:pdf',
        ]);

        $announcement = Announcement::findOrFail($id);
        $pdfFile = $request->file('pdf');
        $slug = Str::slug($request->title);
        $currentData = Carbon::now()->toDateString();

        if (isset($pdfFile)) {
            $pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('announcement')) {
                Storage::disk('public')->makeDirectory('announcement');
            }
            // check old image & delete is exists
            if (Storage::disk('public')->exists('announcement/' . $announcement->pdf)) {
                Storage::disk('public')->delete('announcement/' . $announcement->pdf);
            }
            // pdf for add in exists
            $pdfData = file_get_contents($pdfFile);
            Storage::disk('public')->put('announcement/' . $pdfName, $pdfData);
        } else {
            $pdfName = $announcement->pdf;
        }

        $announcement->title = $request->title;
        $announcement->slug = $slug;
        $announcement->pdf = $pdfName;

        if (isset($request->status)) {
            $announcement->status = true;
        } else {
            $announcement->status = false;
        }

        $announcement->update();

        Toastr::success('You have Update the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notice = Announcement::findOrFail($id);
        // check old image & delete is exists
        if (Storage::disk('public')->exists('notice/' . $notice->notice)) {
            Storage::disk('public')->delete('notice/' . $notice->notice);
        }
        $notice->delete();
        Toastr::success('You have Delete the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Download the specified resource from storage.
     */
    public function download(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        if (isset($announcement)) {
            $path = public_path("storage/announcement/$announcement->pdf");
            if (file_exists($path)) {
                // Increment the view count
                $announcement->increment('download', 1);
                return Response::download($path);
            } else {
                Toastr::error("File not found", 'Error');
                return redirect()->back();
            }
        }
    }
}
