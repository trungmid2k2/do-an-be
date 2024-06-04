<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    //

    public function getStatistics()
    {
        $userCount = User::where('role', 'USER')->count();
        $godCount = User::where('role', 'GOD')->count();
        $jobCount = Job::count();
        $commentCount = Comment::count();
        return response()->json([
            'user_count' => $userCount,
            'jobs_count' => $jobCount,
            'comment_count' => $commentCount,
            "god_count" => $godCount,
        ]);
    }
}
