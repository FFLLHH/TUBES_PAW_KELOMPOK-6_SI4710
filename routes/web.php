<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('userCreate');
    Route::post('/users/store', [UserController::class, 'store'])->name('userStore');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('userUpdate');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('userDelete');