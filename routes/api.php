<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/transfer', [TransactionController::class, 'transfer'])
    ->middleware(['auth:sanctum']);

Route::get('/transactions', [TransactionController::class, 'transactions'])
    ->middleware(['auth:sanctum']);

require __DIR__ . '/auth.php';