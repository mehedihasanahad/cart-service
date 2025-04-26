<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// public routes
Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the Cart Service!']);
});
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// protected routes
Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('carts', CartController::class);
    Route::post('carts/{id}/checkout', [CartController::class, 'checkout']);

    // Example for admin only:
    // Route::apiResource('carts', CartController::class)->middleware('role:admin');
});