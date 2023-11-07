<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Pow;
class POWController extends Controller
{
    public function create(request $request): JsonResponse
    {
        $request->validate([
            'pows' => ['array'],
        ]);

        $powsData = $request->input('pows');

        foreach ($powsData as $powItem) {
            $pow = new Pow;
            $pow->userId= $request->user()->id;
            $pow->title = $powItem['title'];
            $pow->description = $powItem['description'];
            $pow->link = $powItem['link'];
            $pow->skills = $powItem['skills'];
            $pow->subSkills = $powItem['subSkills'];
            $pow->save();
        }

        return response()->json(['message' => 'Data saved successfully']);

    }
}
