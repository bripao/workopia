<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Job;

class BookmarkSeeder extends Seeder
{
    public function run(): void
    {
        // Get the test user
        $testUser = User::where('email', 'test@test.com')->firstOrFail();

        // Get all job IDs
        $jobIds = Job::pluck('id')->toArray();

        // Randomly select job IDs to bookmark
        $randomJobIds = array_rand($jobIds, 3); // Change 3 to however many you want to bookmark

        // Attach the selected jobs as bookmarks for the test user
        foreach ($randomJobIds as $jobId) {
            $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }
    }
}
