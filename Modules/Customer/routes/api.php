<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Customer\App\Http\Controllers\CustomerController;
use Modules\Customer\App\Http\Controllers\CustomerImportExportController;

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
    Route::get('customer', fn (Request $request) => $request->user())->name('customer');
});

Route::apiResource('customers', CustomerController::class);

Route::post('customers/import', [CustomerImportExportController::class, 'import']);
Route::get('customers/export', [CustomerImportExportController::class, 'export']);

Route::get('customers/{customerId}', [CustomerController::class, 'show']);
Route::put('customers/{customerId}', [CustomerController::class, 'update']);
Route::delete('customers/{customerId}', [CustomerController::class, 'destroy']);
