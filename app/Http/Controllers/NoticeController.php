<?php

namespace App\Http\Controllers;

use App\Models\Notice;

class NoticeController extends Controller
{
    /**
     * Notice the specified resource from storage.
     */
    public function notice()
    {
        $notices = Notice::latest()->paginate(15);
        return view('notice', compact('notices'));
    }
    
    /**
     * Notice details the specified resource from storage.
     */
    public function noticeDetails($slug)
    {
        $notice = Notice::where('slug', $slug)->get()->first();
        return view('notice', compact('notice'));
    }
}
