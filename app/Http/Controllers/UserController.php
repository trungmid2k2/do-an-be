<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Pow;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Show the currently authenticated user.
     */
    public function show(): UserResource
    {
        return new UserResource(Auth::user());
    }
    public function getAllInfo(Request $request): JsonResponse
    {
        try {
            $userData = User::where('username', $request->username)->first();
            $userData->PoW = Pow::where('userId', $userData->id)->get();
            // if($userData->private and $userData->id != $request->user('id')) {
            //     throw new \Exception('User not found');
            // }
            return response()->json($userData, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch users: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Update the currently authenticated user.
     */
    public function update(Request $request): JsonResponse
    {
        $input = $request->all();
        $id = $request->user()->id;
        // $addUserSponsor = $input['addUserSponsor'];
        // $memberType = $input['memberType'] || "";
        $skills = $input['skills'];
        $updateAttributes = collect($input)->except(['id','username','skills'])->all();
        
        try {
            DB::beginTransaction();

            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => "User with ID $id not found"], 404);
            }

            $updatedData = array_merge($updateAttributes, ['skills' => $skills]);

            $user->update($updatedData);
            
            // if ($addUserSponsor && array_key_exists('currentSponsorId', $updateAttributes)) {
                // UserCompany::create([
                //     'userId' => $id,
                //     'sponsorId' => $updateAttributes['currentSponsorId'],
                //     'role' => $memberType,
                // ]);
            // }

            DB::commit();

            return response()->json($user);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json($updatedData, 400);
        }
    }

    

    /**
     * Update the password of the currently authenticated user.
     */
    public function changePassword(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 'Password updated.'
        ]);
    }
}
