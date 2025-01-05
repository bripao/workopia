<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Job;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->paginate(10);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    public function store(Job $job): RedirectResponse
    {

        $user = Auth::user();

        // Check if the job is already bookmarked
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('status', 'Job is already bookmarked.');
        }

        // Create a new bookmark
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('status', 'Job bookmarked successfully.');
    }

    public function destroy(Job $job): RedirectResponse
    {
        $user = Auth::user();

        // Check if the job is bookmarked before trying to remove it
        if (!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is not bookmarked.');
        }

        // Remove the bookmark
        $user->bookmarkedJobs()->detach($job->id);

        return back()->with('status', 'Job removed from bookmarks successfully.');
    }
}
