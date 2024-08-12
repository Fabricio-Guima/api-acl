<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {

    }

    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->email);

        if(!$user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        //deloga todos que estão logados neste conta atual
        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token ]);
    }

    public function me()
    {
        $user = Auth::user();
        $user->load('permissions');
        return new UserResource($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([], 204);
    }


}
