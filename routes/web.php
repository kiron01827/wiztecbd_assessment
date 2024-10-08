<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => 'admin'], function () {
        Route::resource('/events', EventsController::class);
        Route::get('/events/show_bookings/{id}', [EventsController::class, 'show_bookings'])->name('events.show_bookings');
    });
    Route::group(['middleware' => 'user'], function () {
        Route::resource('/bookings', BookingsController::class);
    });
    Route::post('/getEventData', [EventsController::class, 'getEventData'])->name('getEventData');
});
