<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ListingController extends Controller
{
    public function getAll(request $request): JsonResponse
    {
        // $params = $request->query();
        $category = $request->input('category');
        $filter = $request->input('filter');
        $type = $request->input('type');
        $take = $request->has('take') ? (int)$request->input('take') : 10;

        $result = [
            'jobs' => [],
        ];

        $filterToSkillsMap = [
            'Development' => ['Frontend', 'Backend', 'Blockchain'],
            'Design' => ['Design'],
            'Content' => ['Content'],
            'Frontend' => ['Frontend'],
            'Backend' => ['Backend'],
            'Blockchain' => ['Blockchain'],
        ];

        $skillsToFilter = $filterToSkillsMap[$filter] ?? [];

        $skillsFilter = [];

        if (count($skillsToFilter) > 0) {
            if ($filter === 'Development') {
                $skillsFilter = [
                    'OR' => array_map(function ($skill) {
                        return ['skills->path->[*]->skills->array_contains' => $skill];
                    }, $skillsToFilter),
                ];
            } else {
                $skillsFilter = [
                    'skills->path->[*]->skills->array_contains' => $skillsToFilter,
                ];
            }
        }

        try {
            // if (!$category || $category === 'all') {
                $jobs = Job::
                    where('isPublished', true)
                    ->where('isActive', true)
                    ->where('hackathonprize', false)
                    ->where('isArchived', false)
                    ->where('status', 'OPEN')
                    ->where('deadline', '>=', Carbon::now())
                    ->where($skillsFilter)
                    ->with('company')
                    ->orderBy('deadline', 'asc')
                    ->limit($take)
                    ->get();

                $sortedData = $jobs->sortBy(function ($job) {
                    return Carbon::parse($job->deadline);
                })->values()->all();

                $result['jobs'] = $sortedData;
            // } elseif ($category === 'jobs') {
            //     $jobs = Job::where('isPublished', true)
            //         ->where('isActive', true)
            //         ->where('hackathonprize', false)
            //         ->where('isArchived', false)
            //         ->where('status', 'OPEN')
            //         ->where('type', $type)                    
            //         ->where('deadline', '>=', Carbon::now()->subMonth())
            //         ->where($skillsFilter)
            //         ->orderBy('deadline', 'desc')
            //         ->get();

            //     $sortedData = $jobs->sortBy(function ($job) {
            //         return Carbon::parse($job->deadline);
            //     })->values()->all();

            //     $splitIndex = collect($sortedData)->search(function ($job) {
            //         return Carbon::now()->isAfter(Carbon::parse($job->deadline));
            //     });

            //     if ($splitIndex >= 0) {
            //         $jobsOpen = array_reverse(array_slice($sortedData, 0, $splitIndex));
            //         $jobsClosed = array_slice($sortedData, $splitIndex);

            //         $result['jobs'] = array_merge($jobsOpen, $jobsClosed);
            //     } else {
            //         $result['jobs'] = array_slice($sortedData, 0, $take);
            //     }
            // } elseif ($category === 'requ') {
            //     $jobs = Job::where('isPublished', true)
            //         ->where('isActive', true)
            //         ->where('hackathonprize', true)
            //         ->where('isArchived', false)
            //         ->where('status', 'OPEN')
            //         ->where('deadline', '>=', Carbon::now()->subMonth())
            //         ->where($skillsFilter)
            //         // ... Add other conditions ...
            //         ->orderBy('deadline', 'desc')
            //         ->get();

            //     $sortedData = $jobs->sortBy(function ($job) {
            //         return Carbon::parse($job->deadline);
            //     })->values()->all();

            //     $splitIndex = collect($sortedData)->search(function ($job) {
            //         return Carbon::now()->isAfter(Carbon::parse($job->deadline));
            //     });

            //     if ($splitIndex >= 0) {
            //         $jobsOpen = array_reverse(array_slice($sortedData, 0, $splitIndex));
            //         $jobsClosed = array_slice($sortedData, $splitIndex);

            //         $result['jobs'] = array_merge($jobsOpen, $jobsClosed);
            //     } else {
            //         $result['jobs'] = array_slice($sortedData, 0, $take);
            //     }
            // }

           
            return response()->json($result);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while fetching listings',
            ], 400);
        }
    }
}
