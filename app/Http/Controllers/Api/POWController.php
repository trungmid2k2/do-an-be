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
            $pow->userId = $request->user()->id;
            $pow->title = $powItem['title'];
            $pow->description = $powItem['description'];
            $pow->link = $powItem['link'];
            $pow->skills = $powItem['skills'];
            $pow->subSkills = $powItem['subSkills'];
            $pow->save();
        }

        return response()->json(['message' => 'Data saved successfully']);
    }
    public function get(request $request): JsonResponse
    {
        $userId = $request->input('userId');

        $powsData = Pow::where('userId', $userId)->get();

        return response()->json($powsData);
    }
    public function edit(request $request): JsonResponse
    {

        $request->validate([
            'pows' => ['array'],
        ]);
        $userId = $request->user()->id;
        $pows = $request->all()['pows'] ?? [];

        if (!$pows) {
            return response()->json(['error' => 'The "pows" field is missing in the request body.'], 400);
        }

        $existingPoWs = PoW::where('userId', $userId)->get(['id'])->toArray();

        $existingIds = array_column($existingPoWs, 'id');

        $incomingIds = array_filter(array_column($pows, 'id'));
        $idsToDelete = array_diff($existingIds, $incomingIds);
        $createData = [];
        $updateData = [];


        foreach ($pows as $pow) {
            if (empty($pow)) {
                throw new \Exception('One of the data entries is undefined or null.');
            }
            
            unset($pow['created_at']);
            unset($pow['updated_at']);

            $id = $pow['id'] ?? null;
            $otherFields = array_diff_key($pow, ['id']);

            if ($id) {
                $updateData[] = [
                    'id' => $id,
                    'data' => array_merge($otherFields, ['userId' => $userId])
                ];
            } else {
                $createData[] = array_merge($otherFields, ['userId' => $userId]);
            }
        }


        try {
            if (!empty($createData)) {
                foreach ($createData as $powItem) {
                    $pow = new Pow;
                    $pow->userId = $request->user()->id;
                    $pow->title = $powItem['title'];
                    $pow->description = $powItem['description'];
                    $pow->link = $powItem['link'];
                    $pow->skills = $powItem['skills'];
                    $pow->subSkills = $powItem['subSkills'];
                    $pow->save();
                }                
            }

            if (!empty($updateData)) {
                foreach ($updateData as $data) {
                    PoW::where('id', $data['id'])->update($data['data']);
                }
            }
            if (!empty($idsToDelete)) {
                foreach ($idsToDelete as $id) {
                    PoW::where('id', $id)->delete();
                }
            }

            return response()->json(['success' => 'PoWs processed successfully'], 200);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}
