<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticationThrottler;
use Illuminate\Support\Facades\Route;

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
Route::post('/users', [UserController::class, 'store']);
Route::post('/authenticate', [UserController::class, 'authenticateUser'])->middleware(
    AuthenticationThrottler::class
);

Route::middleware(['auth:api'])->group(function () {
    // Users
    Route::delete('/users/{userId}', [UserController::class, 'destroy']);
    Route::put('/users/{userId}', [UserController::class, 'update']);
    Route::patch('/users/{userId}', [UserController::class, 'patch']);
    Route::get('/users/{userId}', [UserController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);

    // Trips
    Route::get('/trips', [TripController::class, 'index']);
    Route::post('/trips', [TripController::class, 'store']);
    Route::get('/trips/{slug}', [TripController::class, 'show']);

    //Bookings
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings/{tripId}', [BookingController::class, 'store']);
});
