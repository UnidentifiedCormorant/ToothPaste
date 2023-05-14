<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintsController;
use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\Api\PastaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::get('/', [IndexController::class, 'index']);

Route::get('logout', [AuthController::class, 'logout']);

Route::post('auth', [AuthController::class, 'auth']);
Route::post('newUser', [AuthController::class, 'newUser']);

Route::get('myPastas', [PastaController::class, 'myPastas']);
Route::get('/{hash}', [PastaController::class, 'show']);
Route::post('/', [PastaController::class, 'store']);

Route::get('changeBan/{id}', [AdminController::class, 'changeBan']);

Route::prefix('complaints')->group(function ()
{
    Route::post('/store', [ComplaintsController::class, 'store']);
});
