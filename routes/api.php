<?php

use App\Http\Controllers\api\Auth\AuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PermissionUserController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->post('/me', [AuthController::class, 'me'])->name('auth.me');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/permissions', PermissionController::class);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/{user}/permissions', [PermissionUserController::class, 'getPermissionsOfUser'])->name('users.permissions');
    Route::post('/users/{user}/permissions-sync', [PermissionUserController::class, 'syncPermissionsOfUser'])->name('users.permissions.sync');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}',[UserController::class, 'destroy'])->name('users.destroy');
});


Route::get('/', fn () => response()->json(['message' => 'Hello World!']));
