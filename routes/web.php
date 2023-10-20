<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product;
use App\Http\Controllers\CustomerProduct;

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Cutomer Routes 
Route::get('/', function(){
    return view('dashboard');
});

Route::get('cat', [CategoryController::class, 'index']);

Route::get('CustomerPanel.viewProduct/{id}', [CustomerProduct::class, 'viewProduct'])->name('CustomerPanel.viewProduct');
Route::get('search', [CustomerProduct::class, 'search'])->name('CustomerProduct.search');
Route::post('/addToCart', [CustomerProduct::class, 'addToCart']);
Route::get('/CartList', [CustomerProduct::class, 'CartList']);
Route::get('/category/{category}', [CustomerProduct::class, 'show']);
Route::post('/removeFromCart', [CustomerProduct::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/proceedToPayment', [CustomerProduct::class, 'proceedToPayment'])->name('proceedToPayment');

Route::post('/save-order', [OrderController::class, 'saveOrder'])->name('saveOrder');
Route::get('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');
Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('CustomerPanel.history');
Route::get('/total', [OrderController::class, 'dashboard'])->name('totalOrders');



Route::get('/home', [App\Http\Controllers\CustomerProduct::class, 'index'])->name('home');
Route::get('category', [CategoryController::class, 'index']);
Route::get('/welcome', function(){
    return view('welcome');
});




// Admin Routes 

Route::middleware(['admins'])->group(function () {
});
    Route::get('/products/dashboard', [AdminController::class, 'dashboard']);
    Route::resource('/products', ProductController::class);
    Route::view('view', 'products.create');
    Route::get('product', [CustomerProduct::class, 'index']);


Route::get('/admin', function () {
    return view('login');
});

Auth::routes();

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);









