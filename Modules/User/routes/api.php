<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\UserController;
use Modules\User\App\Http\Controllers\AuthController;
use Modules\User\App\Http\Controllers\ProfileController;
use Modules\User\App\Http\Controllers\SettingsController;
use Modules\User\App\Http\Controllers\DashboardController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('user', fn (Request $request) => $request->user())->name('user');
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('settings/change-password', [SettingsController::class, 'changePassword']);
    Route::get('settings/permissions', [SettingsController::class, 'getPermissions']);
    Route::put('settings/permissions', [SettingsController::class, 'updatePermissions']);
    Route::get('settings/groups', [SettingsController::class, 'getGroups']);
    Route::put('settings/groups', [SettingsController::class, 'updateGroups']);
    Route::get('dashboard', [DashboardController::class, 'index']);
});

Route::apiResource('users', UserController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
