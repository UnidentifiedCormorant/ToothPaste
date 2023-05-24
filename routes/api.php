<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintsController;
use App\Http\Controllers\Api\PastaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('logout', [AuthController::class, 'logout']);

Route::post('auth', [AuthController::class, 'auth']);
Route::post('newUser', [AuthController::class, 'newUser']);

Route::group(['middleware' => 'auth.check:sanctum'], function () {
    Route::get('myPastas', [PastaController::class, 'myPastas']);
    Route::get('/{hash}', [PastaController::class, 'show']);
    Route::post('/', [PastaController::class, 'store']);
});

Route::prefix('complaints')->group(function () {
    Route::post('/store', [ComplaintsController::class, 'store']);
});

Route::middleware(['auth.check:sanctum', 'CheckAdmin'])->prefix('admin')->group(function () {
    Route::get('users', [AdminController::class, 'users']);
    Route::get('complaints', [AdminController::class, 'complaints']);
    Route::get('changeBan/{id}', [AdminController::class, 'changeBan']);
});

