<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HotelController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/item', [ItemController::class, 'index']);
    Route::post('/item/{id}/show', [ItemController::class, 'show'])->name('item.store');
    Route::post('/item', [ItemController::class, 'store'])->name('item.store');
    Route::delete('/item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::post('/item/sort-update', [ItemController::class, 'sortUpdate']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::put('/order/{id}', [OrderController::class, 'update']);
    Route::get('/orders/list', [OrderController::class, 'partialList']);

    Route::get('/hotel', [HotelController::class, 'index']);
    Route::post('/hotel/update', [HotelController::class, 'update']);

});

Route::get('/icons/{any}', function ($any) {
    return 'Laravelが受け取った: ' . $any;
})->where('any', '.*');

require __DIR__.'/auth.php';
