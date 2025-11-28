<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/rooms', [RoomController::class, 'index']); // all users
Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::get('/rooms/{room}/check-availability', [ReservationController::class, 'checkAvailability']);


Route::middleware('auth:sanctum')->group(function () {


    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

        Route::post('/reservations', [ReservationController::class, 'store']);
    Route::middleware('role:admin')->group(function () {
        Route::post('/rooms', [RoomController::class, 'store']);
        Route::put('/rooms/{room}', [RoomController::class, 'update']);
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);
        Route::get('/admin/reservations', [ReservationController::class, 'adminIndex']);
        Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);
        Route::get('/admin/dashboard-stats', [DashboradController::class, 'stats']);

    });

    // Reservations
    Route::get('/my-reservations', [ReservationController::class, 'myReservations']);
});
