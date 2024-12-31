<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $jobs = Job::latest()->limit(9)->get();
        return view('pages.index', compact('jobs'));
    }
}
