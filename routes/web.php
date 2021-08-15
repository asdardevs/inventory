<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        
    ]);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('beranda', [HomeController::class, 'index'])->name('beranda.index');
    Route::resource('product', ProductController::class)->only('index','store','destroy');
    Route::resource('customer', CustomerController::class)->only('index','store','destroy');
  
});

// Route::resource('/prodi', ProdiController::class);
