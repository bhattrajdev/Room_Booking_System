<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\IndexController;
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


// Auth related routes start

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/signup', [AuthController::class, 'postSignup'])->name('signup.post');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Auth related routes end

Route::get('viewDetail/{slug}', [IndexController::class, 'roomDetail']);
Route::get('viewDetail/{slug}', [IndexController::class, 'roomDetail']);

Route::middleware(['login'])->group(function () {
    Route::post('/booknow', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'show'])->name('booking');
    Route::put('/bookings/{id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{id}', [BookingController::class, 'deleteBooking']);

    Route::middleware(['admin'])->group(function () {
        Route::resource('/room', RoomController::class);
        Route::get('/customer', [AuthController::class, 'getUsers']);
        Route::resource('/category', CategoryController::class);
        Route::resource('/facility', FacilityController::class);
        Route::get('/bookings/all', [BookingController::class, 'showAll'])->name('bookings.all');
        Route::put('/booking/status/{id}', [BookingController::class, 'updateStatus'])->name('booking.status.update');
    });
});
