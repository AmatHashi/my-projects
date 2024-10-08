<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

Route::post('/update', [CartController::class, 'udate'])->name('update');