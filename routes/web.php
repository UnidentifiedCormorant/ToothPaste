<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PastaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('auth', [AuthController::class, 'auth'])->name('auth');
Route::post('newUser', [AuthController::class, 'newUser'])->name('newUser');

Route::name('pastas.')->group( function (){
    Route::get('myPastas', [PastaController::class, 'myPastas'])->name('myPastas');
    Route::get('/{hash}', [PastaController::class, 'show'])->name('show');  //->middleware('signed');
    Route::post('/', [PastaController::class, 'store'])->name('store');
});
