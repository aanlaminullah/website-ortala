<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $latestAnnouncements = Announcement::orderBy('date', 'desc')->take(2)->get();

        return view('home', compact('latestAnnouncements'));
    }
}
