<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Invoice\App\Http\Controllers\InvoiceController;
use Modules\Invoice\App\Http\Controllers\InvoiceImportExportController;

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
    Route::get('invoice', fn (Request $request) => $request->user())->name('invoice');
});

Route::apiResource('invoices', InvoiceController::class);
Route::get('invoices/{invoice}/with-customer', [InvoiceController::class, 'showWithCustomer']);
Route::post('invoices/import', [InvoiceImportExportController::class, 'import']);
Route::get('invoices/export', [InvoiceImportExportController::class, 'export']);
Route::get('invoices/{invoiceNo}', [InvoiceController::class, 'showByNo']);
Route::put('invoices/{invoiceNo}', [InvoiceController::class, 'updateByNo']);
Route::delete('invoices/{invoiceNo}', [InvoiceController::class, 'destroyByNo']);
