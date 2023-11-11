<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function update(request $request): JsonResponse
    {       
        return response()->json(['message' => 'Data saved successfully']);

    }
    public function create(request $request): JsonResponse
    {       
        return response()->json(['message' => 'Data saved successfully']);

    }
    public function like(request $request): JsonResponse
    {       
        return response()->json(['message' => 'Data saved successfully']);

    }
    public function addPayment(request $request): JsonResponse
    {       
        return response()->json(['message' => 'Data saved successfully']);

    }
    public function toggleWinner(request $request): JsonResponse
    {       
        return response()->json(['message' => 'Data saved successfully']);

    }
    public function listJob(request $request): JsonResponse
    {       
        return response()->json(['message' => 'Data saved successfully']);

    }
}
