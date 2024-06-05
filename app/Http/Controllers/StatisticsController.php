<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    public function getQuantity()
    {
        try {
            $statisticsUser = Cache::remember('statistics', 600, function () {
                $userCount = User::where('role', 'USER')->count();

                $today = Carbon::today();
                $yesterday = Carbon::yesterday();
                $startOfWeek = Carbon::now()->startOfWeek();
                $endOfWeek = Carbon::now()->endOfWeek();
                $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
                $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
                $startOfMonth = Carbon::now()->startOfMonth();
                $endOfMonth = Carbon::now()->endOfMonth();
                $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
                $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

                $usersToday = User::whereDate('created_at', $today)->count();

                $usersYesterday = User::whereDate('created_at', $yesterday)->count();
                $usersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

                $usersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
                $usersThisMonth = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
                $usersLastMonth = User::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

                return [
                    'user_created_count' => $userCount,
                    'users_created_today' => $usersToday,
                    'users_created_yesterday' => $usersYesterday,
                    "users_created_this_week" => $usersThisWeek,
                    "users_created_this_month" => $usersThisMonth,
                    'users_created_last_week' => $usersLastWeek,
                    'users_created_last_month' => $usersLastMonth,
                ];
            });

            return response()->json(["user" => $statisticsUser]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to retrieve statistics',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
