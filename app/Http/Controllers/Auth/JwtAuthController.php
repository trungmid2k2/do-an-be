<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class JwtAuthController extends Controller
{
    /**
     * Register a new user and return an access token.
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'lastname' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'username' => ['required', 'unique:users', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'email' => ['required', 'unique:users', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'isVerified'=> true,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user)); // send email xac thuc

        return response()->json([
            'status' => 'user-created'
        ]);
    }

    /**
     * Authenticate a user and return an access token.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only(['username', 'password']);

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'wrong-credentials'
            ], 401);
        }

        return response()->json([
            'user' => new UserResource(Auth::user()),
            'access_token' => $token,
        ]);
    }

    /**
     * Log out the currently authenticated user (invalidate the token).
     */
    public function logout(): Response
    {
        Auth::logout();

        return response()->noContent();
    }

    /**
     * Refresh the currently authenticated user's access token.
     */
    public function refresh(): JsonResponse
    {
        $token = Auth::refresh();

        return response()->json([
            'access_token' => $token,
        ]);
    }
}
