<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BetItemsController;
use App\Http\Controllers\BetsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ListingsController;
use App\Http\Middleware\AdminOnly;
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
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/login', [LoginController::class, 'store'])->name('login');
});

// Logged in
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], static function() {
    Route::delete('/logout', [AuthController::class, 'logout']);

    // Listings
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/listings', [ListingsController::class, 'index'])->name('listings.index');

    // Bets
    Route::post('/listings/{listing}/bets', [BetsController::class, 'store']);
    Route::get('/listings/{listing}/bets/{bet}/items/add', [BetItemsController::class, 'create']);
    Route::post('/listings/{listing}/bets/{bet}/items', [BetItemsController::class, 'store']);

    // Items
    Route::get('items', [ItemsController::class, 'index'])->name('items.index');
    Route::get('items/create', [ItemsController::class, 'create']);
    Route::post('items', [ItemsController::class, 'store']);
    Route::get('items/{item}', [ItemsController::class, 'show'])->name('items.show');
    Route::put('items/{item}', [ItemsController::class, 'update']);
    Route::get('items/{item}/edit', [ItemsController::class, 'edit']);
    Route::get('items/{item}/delete', [ItemsController::class, 'delete']);
    Route::delete('items/{item}', [ItemsController::class, 'destroy']);

    Route::group(['middleware' => [AdminOnly::class]], static function () {
        Route::get('/events', [EventsController::class, 'index'])->name('events.index');

        Route::get('/listings/create', [ListingsController::class, 'create'])->name('listings.create');
        Route::post('/listings', [ListingsController::class, 'store']);

        // Categories
        Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CategoriesController::class, 'create']);
        Route::post('categories', [CategoriesController::class, 'store']);
        Route::get('categories/{category}/edit', [CategoriesController::class, 'edit']);
        Route::put('categories/{category}', [CategoriesController::class, 'update']);
        Route::get('categories/{category}/delete', [CategoriesController::class, 'delete']);
        Route::delete('categories/{category}', [CategoriesController::class, 'destroy']);
    });

    Route::get('/listings/{listing}', [ListingsController::class, 'show'])->name('listings.show');
});
