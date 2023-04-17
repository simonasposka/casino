<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingsController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', [HomeController::class, 'index']);

// Auth
Route::group(['middleware' => [RedirectIfAuthenticated::class]], static function() {
    Route::get('/register', [AuthController::class, 'register'])->name('register.index');
    Route::get('/login', [AuthController::class, 'login'])->name('login.index');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/login', [LoginController::class, 'store'])->name('login');
});


// Logged in
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], static function() {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/events', [EventsController::class, 'index'])->name('events.index');
    Route::get('/listings', [ListingsController::class, 'index'])->name('listings.index');
    Route::get('/listings/create', [ListingsController::class, 'create'])->name('listings.create');
    Route::post('/listings', [ListingsController::class, 'store']);
    Route::get('/listings/{listing}', [ListingsController::class, 'show']);
});
