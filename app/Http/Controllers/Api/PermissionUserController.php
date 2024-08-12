<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {

    }

    public function syncPermissionsOfUser(string $id, Request $request)
    {
        $response = $this->userRepository->syncPermissions($id, $request->permissions );

        if(!$response) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => 'Permissions updated'], 200);
    }

    public function getPermissionsOfUser(string $id)
    {
        if(!$this->userRepository->findById($id)) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $permissions = $this->userRepository->getPermissionsByUserId($id);
        return PermissionResource::collection($permissions);
    }
}
