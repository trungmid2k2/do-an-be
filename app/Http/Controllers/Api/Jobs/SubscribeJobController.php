<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use App\Models\JobSubcrible;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeJobController extends Controller
{
    public function get(request $request): JsonResponse
    {
        $jobId = $request->input("jobId");
        try {
            $result = JobSubcrible::where('jobId', $jobId)
                ->where('isActive', true)
                ->with('user')
                ->get();

            return response()->json($result, 200);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => "Error occurred while fetching Subcrible."
            ], 400);
        }
    }

    public function check(request $request): JsonResponse
    {
        $user = Auth::user();
        $jobId = $request->input("jobId");
        try {
            $result = JobSubcrible::where('jobId', $jobId)
                ->where('userId', $user->id)
                ->where('isActive', true)
                ->get();

            return response()->json(!$result->isEmpty(), 200);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => "Error occurred while fetching count."
            ], 400);
        }
    }
    public function count(request $request): JsonResponse
    {
        $jobId = $request->input("jobId");
        try {
            $result = JobSubcrible::where('jobId', $jobId)
                ->where('isActive', true)
                ->count();

            return response()->json($result, 200);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => "Error occurred while fetching count."
            ], 400);
        }
    }
    public function subscribe(request $request): JsonResponse
    {
        try {
            $userId = $request->user()->id;
            $jobId = $request->input("jobId");

            $existingRecord = JobSubcrible::where('userId', $userId)->where('jobId', $jobId)->first();
            if ($existingRecord) {
                $existingRecord->isActive = true;
                $existingRecord->save();
                return response()->json(['message' => 'Done']);
            }

            $sub = new JobSubcrible;
            $sub->userId = $request->user()->id;
            $sub->email = $request->input('email');
            $sub->jobId = $jobId;
            $sub->phoneNumber = $request->input('phoneNumber');
            $sub->otherInfo = $request->input('otherInfo');
            $sub->save();
            return response()->json(['message' => 'Done']);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while subscribe jobs.'
            ], 400);
        }
    }
    public function unSubscribe(request $request): JsonResponse
    {
        return response()->json($request);
    }
    public function countUserSubscribedJob(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        try {
            $job_subscribed = JobSubcrible::where('userId', $userId)
                ->where('isActive', true)
                ->count();
            $job_isChosen = JobSubcrible::where('userId', $userId)
                ->where('isChosen', true)
                ->count();
            $data = [
                "job_subscribed" => $job_subscribed,
                "job_isChosen" => $job_isChosen
            ];
            return response()->json($data);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => "Error occurred while counting user subscriptions."
            ], 400);
        }
    }
    public function getJob(Request $request): JsonResponse
    {
        try {

            $query = JobSubcrible::all();

            return response()->json($query);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message' => "Error occurred while counting user subscriptions."
            ], 400);
        }
    }
}
