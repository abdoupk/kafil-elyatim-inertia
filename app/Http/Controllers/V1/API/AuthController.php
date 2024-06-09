<?php

namespace App\Http\Controllers\V1\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Resources\V1\Api\UserLoginResource;
use App\Http\Resources\V1\Api\UserLoginTenantResource;
use App\Http\Resources\V1\SettingsResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'user' => new UserLoginResource(Auth::user()),
                'tenant' => new UserLoginTenantResource(Auth::user()?->tenant),
                'settings' => Auth::user()?->settings ? new SettingsResource(Auth::user()?->settings) : [],
            ]);
        }

        if (! User::where('email', $request->email)->first()) {
            return response()->json([
                'errors' => [
                    'email' => [
                        trans('auth.failed'),
                    ],
                ],
            ], 401);
        }

        // If the email is valid, the password must be incorrect
        return response()->json(['errors' => ['password' => [trans('auth.password')]]], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        /** @var PersonalAccessToken $token */
        $token = $request->user()?->currentAccessToken();
        $token->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
