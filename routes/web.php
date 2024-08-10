<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController ;
use App\Http\Controllers\orderController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\orderDetailController;


Route::get('/home', [HomeController::class,'index'])->name('dashboard');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');

//products
Route::get('/products', [ProductController::class,'index'])->name('products');
Route::get('/add', [ProductController::class,'createForm'])->name('product');
Route::post('/add', [ProductController::class, 'store'])->name('product.store');
Route::get('/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/show/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/delete/{id}',[ProductController::class, 'delete'])->name('product.delete');
Route::get('/itemcart', [ProductController::class,'cart'])->name('product.itemscart');

//customers
Route::get('/customers',[CustomersController::class, 'index'])->name('customers');
Route::get('/create',[CustomersController::class,'create'])->name('customers.create');
Route::post('/create',[CustomersController::class, 'store'])->name('customers.store');

//orders
Route::get('/orders',[orderController::class, 'index'])->name('orders');
Route::get('/create', [orderController::class, 'create'])->name('orders.create');
Route::post('/create',[orderController::class, 'store'])->name('orders.store');

//oredesDetail
Route::get('/all',[orderDetailController::class, 'index'])->name('details');
Route::get('/create', [orderDetailController::class, 'create'])->name('add');
Route::post('/create',[orderDetailController::class, 'store'])->name('ordersdetail.store');


//carts
Route::get('/cart', [CartController::class, 'index'])->name('product.cart');
Route::post('/addcart', [CartController::class, 'addToCart'])->name('cart.sore');
Route::delete('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

// Route::match(['get', 'post'], '/cart', [ProductController::class, 'cartDetails'])->name('cart.show');


//users
Route::get('/signup', [UserController::class, 'createForm'])->name('user.create');
Route::post('/signup', [UserController::class, 'register'])->name('user.store');



include('category.php');