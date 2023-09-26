<?php

namespace App\Http\Controllers\Admin;

use App\Models\UpdateNews;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class UpdateNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $updateNews = UpdateNews::latest()->get();
        return view('admin.update-news.index', compact('updateNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.update-news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => 'required|string',
            'file'     => 'required|mimes:pdf'
        ]);

        $pdfFile = $request->file('file');

        if (isset($pdfFile)) {
            $pdfName = 'update-news-' . uniqid() . '.' . $pdfFile->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('news/update')) {
                Storage::disk('public')->makeDirectory('news/update');
            }
            // pdf for add in exists
            $pdfData = file_get_contents($pdfFile);
            Storage::disk('public')->put('news/update/' . $pdfName, $pdfData);
        } else {
            $pdfName = 'default.pdf';
        }


        $updateNews = new UpdateNews();
        $updateNews->title = $request->title;
        $updateNews->news_type = $request->news_type;
        $updateNews->file = $pdfName;

        if (isset($request->status)) {
            $updateNews->status = true;
        } else {
            $updateNews->status = false;
        }

        $updateNews->save();

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
        $updateNews = UpdateNews::findOrFail($id);
        return view('admin.update-news.edit', compact('updateNews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title'    => 'required|string',
            'file'     => 'mimes:pdf'
        ]);

        $updateNews = UpdateNews::findOrFail($id);

        $pdfFile = $request->file('file');
        if (isset($pdfFile)) {
            $pdfName = 'update-news-' . uniqid() . '.' . $pdfFile->getClientOriginalExtension();
            // check post dir is exists
            if (!Storage::disk('public')->exists('news/update')) {
                Storage::disk('public')->makeDirectory('news/update');
            }
            // check old image & delete is exists
            if (Storage::disk('public')->exists('news/update/' . $updateNews->file)) {
                Storage::disk('public')->delete('news/update/' . $updateNews->file);
            }
            // pdf for add in exists
            $pdfData = file_get_contents($pdfFile);
            Storage::disk('public')->put('news/update/' . $pdfName, $pdfData);
        } else {
            $pdfName = $updateNews->file;
        }

        $updateNews->title = $request->title;
        $updateNews->news_type = $request->news_type;
        $updateNews->file = $pdfName;

        if (isset($request->status)) {
            $updateNews->status = true;
        } else {
            $updateNews->status = false;
        }

        $updateNews->update();

        Toastr::success('You have Update the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
