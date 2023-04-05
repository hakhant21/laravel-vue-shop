<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->as('users:')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/create', [UserController::class,'create'])->name('create');
});
