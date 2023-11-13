<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function create(request $request): JsonResponse

    {
        $user = Auth::user();
        $data = $request->only(['message', 'jobId']);
        $data['authorId'] = $user->id;
        try {
            $comment = Comment::create($data);
            $comment->load('author');

            return response()->json($comment, 200);
        } catch (\Exception $error) {
            // Log the error for debugging purposes
            Log::error('Error occurred while adding a new comment: ' . $error->getMessage());

            return response()->json([
                'error' => $error->getMessage(),
                'message' => 'Error occurred while adding a new comment.'
            ], 400);
        }
    }
    public function get(request $request): JsonResponse

    {
        $jobId = $request->input(`jobId`);
        $skip = $request->input(`jobId`);
        try {
            $result = Comment::where('jobId', $jobId)
                ->where('isActive', true)
                ->where('isArchived', false)
                ->with('author')
                ->orderBy('updated_at', 'desc')
                ->skip($skip)
                ->take(30)
                ->get();

            return response()->json($result, 200);
        } catch (\Exception $error) {
            Log::error('Error occurred while fetching ' . $error->getMessage());

            return response()->json([
                'error' => $error->getMessage(),
                'message' => "Error occurred while fetching",
            ], 400);
        }
    }
}
