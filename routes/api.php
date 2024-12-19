<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'getUser'])->middleware('auth:sanctum');

Route::get('/tasks', [ItemController::class, 'index']);
Route::prefix('/tasks')->group(function() {
    Route::post('/', [ItemController::class, 'store']);
    Route::put('/complete/{id}', [ItemController::class, 'update']);
    Route::put('/{id}', [ItemController::class, 'updateTask']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});
