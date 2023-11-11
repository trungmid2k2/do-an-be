<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MemberCompany;
use App\Models\MemberInvite;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function getMember(Request $request): JsonResponse
    {
        $companyId = $request->input('companyId');
        $skip = $request->input('skip', 0);
        $take = $request->input('take', 15);
        $searchText = $request->input('searchText', '');



        try {

            // $countQuery = MemberCompany::where('companyId', $companyId)->where($whereSearch);
            $countQuery  = MemberCompany::where('companyId', $companyId)
                ->whereHas('user', function ($query) use ($searchText) {
                    $query
                        ->where('email', 'like', "%$searchText%")
                        ->orWhere('username', 'like', "%$searchText%")
                        ->orWhere('firstName', 'like', "%$searchText%")
                        ->orWhere('lastName', 'like', "%$searchText%");
                });


            $total = $countQuery->count();

            $result = $countQuery->skip($skip)->take($take)
                ->with('user:id,email,username,firstname,lastname,photo')
                ->get();

            return response()->json(['total' => $total, 'data' => $result]);
        } catch (\Exception $err) {
            return response()->json(['err' => $err], 400);
        }
    }
    public function inviteMember(Request $request): JsonResponse
    {
        $requestData = $request->all();
        $email = $requestData['email'];
        $userId = $request->user()->id;
        $companyId = $requestData['companyId'];
        $memberType = $requestData['memberType'];

        try {


            $isAdmin  = MemberCompany::where('companyId', $companyId)
                ->where('userId', $userId)
                ->where('role', 'ADMIN')
                ->exists();



            $user = User::select('id', 'email', 'firstname', 'lastname', 'role')
                ->with('currentCompany:id,name')
                ->find($userId);
            if (!$isAdmin and $user->role != 'GOD') {
                throw new \Exception('You are not ADMIN');
            }
            MemberInvite::create([
                'email' => $email,
                'senderId' => $userId,
                'companyId' => $companyId,
                'memberType' => $memberType,
            ]);

            // Mail::send('emails.inviteMemberTemplate', [
            //     'companyName' => optional($user->currentCompany)->name ?? '',
            //     'senderName' => $user->firstName . ' ' . $user->lastName,
            //     'link' => $this->getURL() . 'signup?invite=' . $result->id,
            // ], function ($message) use ($email, $user) {
            //     $message->from('Kash from Superteam <' . env('RESEND_EMAIL') . '>')
            //         ->to($email)
            //         ->subject($user->firstName . ' has invited you to join ' . (optional($user->currentCompany)->name ?? '') . "'s profile on Superteam Earn");
            // });

            return response()->json(['message' => 'invite sent successfully'], 200);
        } catch (\Exception $error) {
            Log::error('Error occurred: ' . $error->getMessage());
            return response()->json(['error' => $error->getMessage(), 'message' => 'Error occurred while adding a new user.'], 400);
        }
    }
    public function getInvite(Request $request): JsonResponse
    {
        $id = $request->input('id');

        try {
            $result = MemberInvite::with('sender')->with('company')->where('id', $id)->first();
            if ($result) {
                return response()->json($result, 200);
            } else {
                return response()->json(['error' => 'Invite not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error occurred while getting the invite.'], 400);
        }
    }
    public function acceptInvite(Request $request): JsonResponse
    {
        $user = Auth::user();
        $inviteId = $request->input('inviteId');
        try {
            $invite = MemberInvite::where('id', $inviteId)->first();
            if ($invite->email != $user->email) {
                throw new \Exception('Incorrect information');
            }
            MemberCompany::create([
                'userId' => $user->id,
                'companyId' => $invite->companyId,
                'role' => $invite->memberType,
            ]);
            return response()->json(['messgae' => 'Done'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error occurred while getting the invite.'], 400);
        }
    }
}
