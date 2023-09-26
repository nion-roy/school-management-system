<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Announcement the specified resource from storage.
     */
    public function announcement($slug)
    {
        $announcement = Announcement::where('slug', $slug)->get()->first();
        return view('announcement', compact('announcement'));
    }
}
