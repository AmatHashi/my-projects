<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\shopController;
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
Route::post('/store', [HomeController::class,'createMessage'])->name('store');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/collection', [HomeController::class,'collection'])->name('collection');
Route::get('/contacts', [HomeController::class, 'findAllContact'])->name('all.contact');
Route::get('/create', [HomeController::class, 'createform'])->name('slideshow.create');
Route::post('/store', [HomeController::class, 'store'])->name('slideshow.store');


//products
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/add', [ProductController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit'); 
    Route::post('/update', [ProductController::class, 'update'])->name('update'); 
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');

});
//categories
Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
   Route::post('store', [CategoryController::class, 'store'])->name('store');
   Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
   Route::post('update', [CategoryController::class,'update'])->name('update');
   Route::get('delete/{id}',[CategoryController::class, 'delete'])->name('delete');
});
//products
Route::get('/filterby', [ProductController::class, 'filterProducts'])->name('filter.products');
Route::get('/show/{id}', [ProductController::class, 'detail'])->name('show');
Route::get('/products/load-more', [ProductController::class, 'loadMore'])->name('products.loadMore');
Route::get('/filterPrice', [ProductController::class, 'SelectedPrices'])->name('filterByPrice');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/itemcart', [ProductController::class,'cart'])->name('product.itemscart');
Route::get('/shop/{id?}', [ProductController::class,'shop'])->name('shop');
//orders
Route::get('/checkout', [OrderController::class, 'get'])->name('checkout');
Route::post('/orders',[orderController::class, 'checkout'])->name('orders.create');
Route::get('/orders', [orderController::class, 'index'])->name('orders.all');

//carts
Route::get('/cart', [CartController::class, 'index'])->name('product.cart');
Route::post('/addcart', [CartController::class, 'addToCart'])->name('cart.sore');
Route::delete('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::prefix('cart')->group(function () {
 Route::post('/update', [CartController::class, 'update'])->name('cart.update');
});

//users
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/signup', [UserController::class, 'createForm'])->name('user.create');
Route::post('/signup', [UserController::class, 'register'])->name('user.store');
Route::get('/login',   [UserController::class, 'loginForm'])->name('login');
Route::post('/login',  [UserController::class, 'login'])->name('user.login');
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update{id}',[UserController::class], 'update')->name('user.modify');

// Route::get('/show/{id}', [ProductController::class, 'detail'])->name('detail');
// Route::match(['get', 'post'], '/update/{id}', [ProductController::class, 'update'])->name('products.update');
// Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
// Route::group(['middleware' => 'auth'], function () {
// });

















