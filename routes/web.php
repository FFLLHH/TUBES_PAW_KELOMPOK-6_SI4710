<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Category
Route::controller(CategoryController::class)->group(function() {
    Route::get('/admin/category', 'index')->name('category');
    Route::get('/admin/category/create', 'create')->name('categoryCreate');
    Route::post('/admin/category/check', 'check')->name('categoryCheck');
    Route::post('/admin/category/save', 'save')->name('categorySave');
    Route::get('/admin/category/delete/{id}/{path}', 'delete')->name('categoryDelete');
    Route::get('/admin/category/edit/{id}', 'edit')->name('categoryEdit');
    Route::post('/admin/category/update/{id}', 'update')->name('categoryUpdate');
});