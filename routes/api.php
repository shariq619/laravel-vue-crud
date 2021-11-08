<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::middleware('auth:api')->get('/athenticated', function () {
    return true;
});*/

//Route::apiResource('tickets',TicketController::class);
Route::apiResource('tickets', TicketController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

/*Route::get('/login', function () {
    return response()->json(['message' => 'Unauthorised'], 401);
})->name('login');*/

/*Route::middleware('auth:api')->group(function () {
    Route::get('users', [AuthController::class, 'users']);
    Route::get('get-user/{id}', [AuthController::class, 'getUserById']);
    Route::post('logout', [AuthController::class, 'logout']);
});*/




