<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/signup', [UserController::class, 'index']);
Route::post('/signup', [UserController::class, 'register'])->name('user.create');
Route::get('signin', [UserController::class, 'showLoginForm'])->name('signin');
Route::post('signin', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');



Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('service', [ServiceController::class, 'index'])->name('service');
    Route::post('create', [ServiceController::class, 'store'])->name('service.store');
    Route::get('edit/{id}', [ServiceController::class, 'edit']);
    Route::post('update', [ServiceController::class, 'update']);

    Route::get('/project', [ProjectController::class, 'index'])->name('project.all');
    Route::post('store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('edit/{id}', [ProjectController::class, 'edit']);
    Route::post('/update', [ProjectController::class, 'modify']);
    Route::get('/delete/{id}', [ProjectController::class,'delete'])->name('project.delete');

    Route::get('/hero',[AboutController::class, 'hero'])->name('hero');
    Route::post('/hero',[AboutController::class,'add'])->name('hero.add');
    Route::put('/hero',[AboutController::class,'modify'])->name('hero.update');
    Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AboutController::class, 'update'])->name('about.update');

});