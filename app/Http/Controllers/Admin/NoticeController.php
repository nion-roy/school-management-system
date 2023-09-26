<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = Notice::latest()->get();
        return view('admin.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'                    => 'required|string',
            'notice'                        => 'required|mimes:pdf',
        ]);


        $pdfFile = $request->file('notice');
        $slug = Str::slug($request->title);
        $currentData = Carbon::now()->toDateString();

        if (isset($pdfFile)) {
            $pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('notice')) {
                Storage::disk('public')->makeDirectory('notice');
            }
            // pdf for add in exists
            $pdfData = file_get_contents($pdfFile);
            Storage::disk('public')->put('notice/' . $pdfName, $pdfData);
        } else {
            $pdfName = 'default.pdf';
        }


        $notice = new Notice();
        $notice->title = $request->title;
        $notice->slug = $slug;
        $notice->notice = $pdfName;
        if (isset($request->status)) {
            $notice->status = true;
        } else {
            $notice->status = false;
        }

        $notice->save();

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
        $notices = Notice::findOrFail($id);
        return view('admin.notice.edit', compact('notices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title'     => 'required|string',
            'notice'    => 'mimes:pdf',
        ]);

        $notice = Notice::findOrFail($id);
        $pdfFile = $request->file('notice');
        $slug = Str::slug($request->title);
        $currentData = Carbon::now()->toDateString();

        if (isset($pdfFile)) {
            $pdfName = $slug . '-' . $currentData . '.' . $pdfFile->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('notice')) {
                Storage::disk('public')->makeDirectory('notice');
            }
            // check old image & delete is exists
            if (Storage::disk('public')->exists('notice/' . $notice->notice)) {
                Storage::disk('public')->delete('notice/' . $notice->notice);
            }
            // pdf for add in exists
            $pdfData = file_get_contents($pdfFile);
            Storage::disk('public')->put('notice/' . $pdfName, $pdfData);
        } else {
            $pdfName = $notice->notice;
        }

        $notice->title = $request->title;
        $notice->slug = $slug;
        $notice->notice = $pdfName;

        if (isset($request->status)) {
            $notice->status = true;
        } else {
            $notice->status = false;
        }

        $notice->update();

        Toastr::success('You have Update the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notice = Notice::findOrFail($id);
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
        $notice = Notice::findOrFail($id);
        if (isset($notice)) {
            $path = public_path("storage/notice/$notice->notice");
            if (file_exists($path)) {
                // Increment the view count
                $notice->increment('download', 1);
                return Response::download($path);
            } else {
                Toastr::error("File not found", 'Error');
                return redirect()->back();
            }
        }
    }
}
