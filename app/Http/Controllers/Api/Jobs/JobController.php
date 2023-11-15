<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobSubcrible;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(request $request): JsonResponse
    {
        $companyId = $request->input('companyId');
        $slug = $request->input('slug');
        $searchText = $request->input('searchText');
        $skip = $request->input('skip', 0);
        $take = $request->input('take', 15);

        $whereSearch = $searchText
            ? [['title', 'like', '%' . $searchText . '%']]
            : [];

        try {
            if ($slug != "") {
                $query = Job::query()
                    ->where('isActive', true)
                    ->where('isArchived', false)
                    ->where('slug', $slug)
                    ->where($whereSearch);
            } else {
                $query = Job::query()
                    ->where('isActive', true)
                    ->where('isArchived', false)
                    ->where('companyId', $companyId)
                    ->where($whereSearch);
            }

            $total = $query->count();

            $result = $query->select('*')
                ->with('subscribes')
                ->with('subscribes.user')
                ->orderBy('deadline', 'desc')
                ->orderBy('id', 'desc')
                ->skip($skip)
                ->take($take)
                ->get();

           
            return response()->json(['total' => $total, 'data' => $result]);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while fetching jobs.'
            ], 400);
        }
    }
    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title, '-', 'en');
        $i = 1;

        while (Job::where('slug', $slug)->exists()) {
            $newTitle = $title . '-' . $i;
            $slug = Str::slug($newTitle, '-', 'en');
            $i++;
        }

        return $slug;
    }
    public function create(request $request): JsonResponse
    {
        $requestData = $request->all();
        // return response()->json($requestData);
        try {
            $slug = $this->generateUniqueSlug($requestData['title']);
            $finalData = array_merge(['title' => $requestData['title'], 'slug' => $slug], $requestData);
            $result = Job::create($finalData);
            return response()->json($result, 200);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while adding a new job.'
            ], 400);
        }
    }
    public function get(request $request,): JsonResponse
    {
        $slug = $request->input('slug');
        try {
            $result = Job::where('slug', $slug)
                ->where('isActive', true)
                ->with(['company', 'poc'])
                ->first();

            if (!$result) {
                return response()->json(['message' => 'Job not found'], 404);
            }

            return response()->json($result);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => "Error occurred while fetching Job with slug={$slug}.",
            ], 400);
        }
    }
    public function update(request $request): JsonResponse
    {
        $jobId = $request->input('jobId');
        $data = $request->input('data');
        $chosen = $request->input('chosen');
        if (is_array($data) && array_key_exists('deadline', $data)) {
            $deadline = $data['deadline'];
            $data['deadline'] = Carbon::parse($deadline)->toDateTimeString();
        }
        try {
            $result = Job::where('id', $jobId)->update($data);
            

            if($chosen >= 0){
                JobSubcrible::where('userId', $chosen)
                ->where('jobId', $jobId)
                ->update(['isChosen'=> true]);
            }

            return response()->json($result, 200);
        } catch (\Exception $error) {

            return response()->json([
                'error' => $chosen,
                'message' => "Error occurred while updating job",
            ], 400);
        }
    }
}
