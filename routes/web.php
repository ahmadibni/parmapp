<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontPageController::class, 'index'])->name('front.index');
Route::get('/details/{product:slug}', [FrontPageController::class, 'details'])->name('front.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('product-transactions', ProductTransactionController::class);
    Route::resource('carts', CartController::class)->middleware('role:buyer');
    Route::post('carts/add/{product}', [CartController::class, 'store'])->middleware('role:buyer')->name('carts.store');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('/products', ProductController::class)->middleware('role:owner');
        Route::resource('/categories', CategoryController::class)->middleware('role:owner');
    });
});

require __DIR__ . '/auth.php';
