<?php

namespace Modules\User\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\User\App\Models\Permission;
use Modules\User\App\Models\Group;

class SettingsController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/settings/change-password",
     *   summary="Change user password",
     *   tags={"Settings"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"currentPassword","newPassword"},
     *       @OA\Property(property="currentPassword", type="string"),
     *       @OA\Property(property="newPassword", type="string")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Password changed successfully"),
     *   @OA\Response(response=400, description="Bad request (e.g., incorrect current password)")
     * )
     */
    public function changePassword(Request $request)
    {
        $user = $request->user();
        if (!Hash::check($request->input('currentPassword'), $user->password)) {
            return response()->json(['message' => 'Incorrect current password'], 400);
        }
        $user->password = bcrypt($request->input('newPassword'));
        $user->save();
        return response()->json(['message' => 'Password changed successfully']);
    }

    /**
     * @OA\Get(
     *   path="/api/settings/permissions",
     *   summary="Get module permissions",
     *   tags={"Settings"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="A list of module permissions",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Permission"))
     *   )
     * )
     */
    public function getPermissions()
    {
        return response()->json(Permission::all());
    }

    /**
     * @OA\Put(
     *   path="/api/settings/permissions",
     *   summary="Update module permissions",
     *   tags={"Settings"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Permission"))
     *   ),
     *   @OA\Response(response=200, description="Permissions updated successfully")
     * )
     */
    public function updatePermissions(Request $request)
    {
        // Basit örnek: Tüm izinleri silip yeniden ekler
        Permission::truncate();
        foreach ($request->all() as $perm) {
            Permission::create($perm);
        }
        return response()->json(['message' => 'Permissions updated successfully']);
    }

    /**
     * @OA\Get(
     *   path="/api/settings/groups",
     *   summary="Get user groups",
     *   tags={"Settings"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="A list of user groups",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Group"))
     *   )
     * )
     */
    public function getGroups()
    {
        return response()->json(Group::all());
    }

    /**
     * @OA\Put(
     *   path="/api/settings/groups",
     *   summary="Update user groups",
     *   tags={"Settings"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Group"))
     *   ),
     *   @OA\Response(response=200, description="Groups updated successfully")
     * )
     */
    public function updateGroups(Request $request)
    {
        // Basit örnek: Tüm grupları silip yeniden ekler
        Group::truncate();
        foreach ($request->all() as $group) {
            Group::create($group);
        }
        return response()->json(['message' => 'Groups updated successfully']);
    }
} 