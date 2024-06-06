<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Company;
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
        $companyCount = Company::count();
        $commentCount = Comment::count();
        return response()->json([
            'user_count' => $userCount,
            'jobs_count' => $jobCount,
            'comment_count' => $commentCount,
            "god_count" => $godCount,
            "company_count" => $companyCount
        ]);
    }
    // public function getQuantity()
    // {
    //     try {
    //         $statisticsUser = Cache::remember('statistics', 600, function () {
    //             $userCount = User::where('role', 'USER')->count();

    //             $today = Carbon::today();
    //             $yesterday = Carbon::yesterday();
    //             $startOfWeek = Carbon::now()->startOfWeek();
    //             $endOfWeek = Carbon::now()->endOfWeek();
    //             $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
    //             $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
    //             $startOfMonth = Carbon::now()->startOfMonth();
    //             $endOfMonth = Carbon::now()->endOfMonth();
    //             $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
    //             $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

    //             $usersToday = User::whereDate('created_at', $today)->count();

    //             $usersYesterday = User::whereDate('created_at', $yesterday)->count();
    //             $usersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

    //             $usersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
    //             $usersThisMonth = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
    //             $usersLastMonth = User::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

    //             return [
    //                 'user_created_count' => $userCount,
    //                 'users_created_today' => $usersToday,
    //                 'users_created_yesterday' => $usersYesterday,
    //                 "users_created_this_week" => $usersThisWeek,
    //                 "users_created_this_month" => $usersThisMonth,
    //                 'users_created_last_week' => $usersLastWeek,
    //                 'users_created_last_month' => $usersLastMonth,
    //             ];
    //         });

    //         return response()->json(["user" => $statisticsUser]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Unable to retrieve statistics',
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function getDataCreated()
    {
        try {
            $statistics = Cache::remember('statistics', 600, function () {
                // User data
                $userCount = User::where('role', 'USER')->count();
                $statisticsData = [
                    'user_created_count' => $userCount,
                    'users_created_today' => User::whereDate('created_at', Carbon::today())->count(),
                    'users_created_yesterday' => User::whereDate('created_at', Carbon::yesterday())->count(),
                ];

                // Data for each day of this week (Users)
                $startOfWeek = Carbon::now()->startOfWeek();
                $weekData = [];
                for ($i = 0; $i < 7; $i++) {
                    $day = $startOfWeek->copy()->addDays($i);
                    $weekData[strtolower($day->format('l'))] = User::whereDate('created_at', $day)->count();
                }
                $statisticsData['week'] = $weekData;

                // Data for each month of this year (Users)
                $startOfYear = Carbon::now()->startOfYear();
                $yearData = [];
                for ($i = 0; $i < 12; $i++) {
                    $month = $startOfYear->copy()->addMonths($i);
                    $yearData[strtolower($month->format('F'))] = User::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
                }
                $statisticsData['year'] = $yearData;

                // Job data
                $jobCount = Job::count();
                $jobStatisticsData = [
                    'job_created_count' => $jobCount,
                    'jobs_created_today' => Job::whereDate('created_at', Carbon::today())->count(),
                    'jobs_created_yesterday' => Job::whereDate('created_at', Carbon::yesterday())->count(),
                ];

                // Data for each day of this week (Jobs)
                $jobWeekData = [];
                for ($i = 0; $i < 7; $i++) {
                    $day = $startOfWeek->copy()->addDays($i);
                    $jobWeekData[strtolower($day->format('l'))] = Job::whereDate('created_at', $day)->count();
                }
                $jobStatisticsData['week'] = $jobWeekData;

                // Data for each month of this year (Jobs)
                $jobYearData = [];
                for ($i = 0; $i < 12; $i++) {
                    $month = $startOfYear->copy()->addMonths($i);
                    $jobYearData[strtolower($month->format('F'))] = Job::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
                }
                $jobStatisticsData['year'] = $jobYearData;

                // Company data
                $companyCount = Company::count();
                $companyStatisticsData = [
                    'company_created_count' => $companyCount,
                    'companies_created_today' => Company::whereDate('created_at', Carbon::today())->count(),
                    'companies_created_yesterday' => Company::whereDate('created_at', Carbon::yesterday())->count(),
                ];

                // Data for each day of this week (Companies)
                $companyWeekData = [];
                for ($i = 0; $i < 7; $i++) {
                    $day = $startOfWeek->copy()->addDays($i);
                    $companyWeekData[strtolower($day->format('l'))] = Company::whereDate('created_at', $day)->count();
                }
                $companyStatisticsData['week'] = $companyWeekData;

                // Data for each month of this year (Companies)
                $companyYearData = [];
                for ($i = 0; $i < 12; $i++) {
                    $month = $startOfYear->copy()->addMonths($i);
                    $companyYearData[strtolower($month->format('F'))] = Company::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count();
                }
                $companyStatisticsData['year'] = $companyYearData;

                return [
                    'user_statistics' => $statisticsData,
                    'job_statistics' => $jobStatisticsData,
                    'company_statistics' => $companyStatisticsData
                ];
            });

            return response()->json($statistics);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to retrieve statistics',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
