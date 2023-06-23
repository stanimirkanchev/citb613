<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservationsController;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::GET('login', [AuthController::class, 'login'])->name('auth.login');
Route::POST('auth', [AuthController::class, 'auth'])->name('auth.attempt'); 
Route::GET('register', [AuthController::class, 'register'])->name('auth.register');
Route::POST('register/create', [AuthController::class, 'create'])->name('auth.register.create');
Route::POST('logout', [AuthController::class, 'logout'])->name('auth.logout');

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
Route::GET('/', [Controller::class, 'index'])->name('home');
Route::GET('/rooms', [RoomsController::class, 'index'])->name('rooms.index');
Route::GET('/room/{room}', [RoomsController::class, 'show'])->name('rooms.show');

Route::POST('/room/reservation/{id}', [ReservationsController::class, 'createReservation'])->name('rooms.reservation.create');
Route::GET('/room/reservation/success/{id}', [ReservationsController::class, 'success'])->name('rooms.reservation.success');