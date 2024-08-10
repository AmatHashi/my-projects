<?php

use App\Http\Controllers\CategoryController;

Route::get('/category', [CategoryController::class,'index'])->name('categories');
// Route::get('/create',[CategoryController::class, 'createForm'])->name('category');
Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/edit{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/update{id}', [CategoryController::class,'update'])->name('category.update');
