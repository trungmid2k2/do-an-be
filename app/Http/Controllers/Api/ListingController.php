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
        $params = $request->query();
        $category = $request->input('category');
        $filter = $request->input('filter');
        $searchText = $request->input('searchText');


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


        $whereSearch = $searchText
            ? [['title', 'like', '%' . $searchText . '%']]
            : [];

        try {
            $query = Job::query();
            $jobs = Job::where('isPublished', true)
                ->where('isActive', true)
                ->where('hackathonprize', false)
                ->where('isArchived', false)
                ->where('deadline', '>=', Carbon::now())
                ->where(function ($query) use ($skillsToFilter) {
                    if (count($skillsToFilter) > 1) {
                        foreach ($skillsToFilter as $skill) {
                            $query->orWhereJsonContains('skills', [['skills' => $skill]]);
                        }
                    } else if (count($skillsToFilter) == 1) {
                        $query->whereJsonContains('skills', [['skills' => $skillsToFilter[0]]]);
                    } else {
                        return;
                    }
                })
                ->where($whereSearch)
                ->with('company')
                ->orderBy('deadline', 'asc')
                ->limit($take)
                ->get();

            // $results = Job::
            $total = $query->count();
            $sortedData = $jobs->sortBy(function ($job) {
                return Carbon::parse($job->deadline);
            })->values()->all();

            $result['jobs'] = $sortedData;



            return response()->json(['total' => $total, "data" => $result]);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while fetching listings',
            ], 400);
        }
    }
}
