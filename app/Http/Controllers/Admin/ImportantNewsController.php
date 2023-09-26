<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ImportantNews;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ImportantNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $importantNews = ImportantNews::latest()->get();
        return view('admin.important-news.index', compact('importantNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.important-news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);

        $links = new ImportantNews();
        $links->title = $request->title;
        $links->links = $request->links;

        if (isset($request->status)) {
            $links->status = true;
        } else {
            $links->status = false;
        }

        $links->save();

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
        $importantNews = ImportantNews::findOrFail($id);
        return view('admin.important-news.edit', compact('importantNews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);

        $links = ImportantNews::findOrFail($id);
        $links->title = $request->title;
        $links->links = $request->links;

        if (isset($request->status)) {
            $links->status = true;
        } else {
            $links->status = false;
        }

        $links->update();

        Toastr::success('You have Update the data Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $links = ImportantNews::findOrFail($id);
        $links->delete();
        Toastr::success('You have Delete the data Successfully', 'Success');
        return redirect()->back();
    }
}
