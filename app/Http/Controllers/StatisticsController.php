<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobSubcrible;
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

                // Data for each day of last week (Users)
                $startOfLastWeek = $startOfWeek->copy()->subWeek();
                $lastWeekData = [];
                for ($i = 0; $i < 7; $i++) {
                    $day = $startOfLastWeek->copy()->addDays($i);
                    $lastWeekData[strtolower($day->format('l'))] = User::whereDate('created_at', $day)->count();
                }
                $statisticsData['last_week'] = $lastWeekData;

                // Weekly comparison (Users)
                $currentWeekTotal = array_sum($weekData);
                $lastWeekTotal = array_sum($lastWeekData);
                $statisticsData['week_comparison'] = [
                    'current_week_total' => $currentWeekTotal,
                    'last_week_total' => $lastWeekTotal,
                    'difference' => $currentWeekTotal - $lastWeekTotal,
                    'percentage_change' => $lastWeekTotal > 0 ? (($currentWeekTotal - $lastWeekTotal) / $lastWeekTotal) * 100 : null,
                ];

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

                // Data for each day of last week (Jobs)
                $jobLastWeekData = [];
                for ($i = 0; $i < 7; $i++) {
                    $day = $startOfLastWeek->copy()->addDays($i);
                    $jobLastWeekData[strtolower($day->format('l'))] = Job::whereDate('created_at', $day)->count();
                }
                $jobStatisticsData['last_week'] = $jobLastWeekData;

                // Weekly comparison (Jobs)
                $currentJobWeekTotal = array_sum($jobWeekData);
                $lastJobWeekTotal = array_sum($jobLastWeekData);
                $jobStatisticsData['week_comparison'] = [
                    'current_week_total' => $currentJobWeekTotal,
                    'last_week_total' => $lastJobWeekTotal,
                    'difference' => $currentJobWeekTotal - $lastJobWeekTotal,
                    'percentage_change' => $lastJobWeekTotal > 0 ? (($currentJobWeekTotal - $lastJobWeekTotal) / $lastJobWeekTotal) * 100 : null,
                ];

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

                // Data for each day of last week (Companies)
                $companyLastWeekData = [];
                for ($i = 0; $i < 7; $i++) {
                    $day = $startOfLastWeek->copy()->addDays($i);
                    $companyLastWeekData[strtolower($day->format('l'))] = Company::whereDate('created_at', $day)->count();
                }
                $companyStatisticsData['last_week'] = $companyLastWeekData;

                // Weekly comparison (Companies)
                $currentCompanyWeekTotal = array_sum($companyWeekData);
                $lastCompanyWeekTotal = array_sum($companyLastWeekData);
                $companyStatisticsData['week_comparison'] = [
                    'current_week_total' => $currentCompanyWeekTotal,
                    'last_week_total' => $lastCompanyWeekTotal,
                    'difference' => $currentCompanyWeekTotal - $lastCompanyWeekTotal,
                    'percentage_change' => $lastCompanyWeekTotal > 0 ? (($currentCompanyWeekTotal - $lastCompanyWeekTotal) / $lastCompanyWeekTotal) * 100 : null,
                ];

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
                    'company_statistics' => $companyStatisticsData,
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

    public function getDataCreatedByMonth(Request $request)
    {
        try {
            $month = strtolower($request->query('month')); // Get month from query parameters and convert to lowercase
            $statistics = Cache::remember("statistics_$month", 600, function () use ($month) {
                // Function to gather statistics
                function gatherStatistics($model, $role = null, $month)
                {
                    $startOfMonth = Carbon::parse($month)->startOfMonth();
                    $endOfMonth = Carbon::parse($month)->endOfMonth();

                    $data = [];
                    for ($day = $startOfMonth; $day <= $endOfMonth; $day->addDay()) {
                        $count = $role ? $model::where('role', $role)->whereDate('created_at', $day)->count() : $model::whereDate('created_at', $day)->count();

                        // Format date as YYYY-MM-DD
                        $formattedDate = $day->toDateString();

                        // Add data for current day to the array
                        $data[$formattedDate] = $count;
                    }

                    return $data;
                }

                // Gather statistics for each model
                $userStatistics = gatherStatistics(User::class, 'USER', $month);
                $jobStatistics = gatherStatistics(Job::class, null, $month);
                $companyStatistics = gatherStatistics(Company::class, null, $month);

                return [
                    'user_statistics' => $userStatistics,
                    'job_statistics' => $jobStatistics,
                    'company_statistics' => $companyStatistics,
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

    public function getDataSubscribesJob()
    {
        try {
            $query = JobSubcrible::all();

            if ($query->isEmpty()) {
                return response()->json([
                    'message' => 'No subscriptions found'
                ], 404);
            }

            return response()->json($query, 200);
        } catch (\Exception $e) {
            // \Log::error('Error while fetching data: ' . $e->getMessage());

            return response()->json([
                'error' => 'Error while fetching data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
