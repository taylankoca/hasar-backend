<?php

namespace Modules\User\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/profile",
     *   summary="Get user profile",
     *   tags={"User Profile"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="User profile data",
     *     @OA\JsonContent(ref="#/components/schemas/UserProfile")
     *   )
     * )
     */
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * @OA\Put(
     *   path="/api/profile",
     *   summary="Update user profile",
     *   tags={"User Profile"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/UserProfileInput")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Profile updated successfully",
     *     @OA\JsonContent(ref="#/components/schemas/UserProfile")
     *   )
     * )
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $user->update($request->only(['name', 'surname', 'avatarUrl']));
        return response()->json($user);
    }
} 