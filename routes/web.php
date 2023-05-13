<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PastaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('auth', [AuthController::class, 'auth'])->name('auth');
Route::post('newUser', [AuthController::class, 'newUser'])->name('newUser');

Route::name('pastas.')->group(function ()
{
    Route::get('myPastas', [PastaController::class, 'myPastas'])->name('myPastas');
    Route::get('/{hash}', [PastaController::class, 'show'])->name('show');  //->middleware('signed');
    Route::post('/', [PastaController::class, 'store'])->name('store');
});

Route::get('changeBan/{id}', [UserController::class, 'changeBan'])->name('changeBan');

Route::name('complaints.')->group(function ()
{
    Route::get('/create/{pastaId}', [ComplaintsController::class, 'create'])->name('create');
    Route::post('/store', [ComplaintsController::class, 'store'])->name('store');
});
