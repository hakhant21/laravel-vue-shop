<?php

use App\Http\Controllers\Vendors\Products\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendors/products')->as('vendors:products:')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
});
