<?php

namespace Modules\User\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/login",
     *   summary="User Login",
     *   tags={"Authentication"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email"),
     *       @OA\Property(property="password", type="string", format="password")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful login",
     *     @OA\JsonContent(@OA\Property(property="token", type="string"))
     *   ),
     *   @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $user = \Modules\User\App\Models\User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Login successful']);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * @OA\Post(
     *   path="/api/logout",
     *   summary="User Logout",
     *   tags={"Authentication"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="Successful logout")
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
} 