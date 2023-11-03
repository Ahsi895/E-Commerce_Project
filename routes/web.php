<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product;
use App\Http\Controllers\CustomerProduct;

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AbandonedCartController;
use App\Http\Controllers\CouponsController;



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

// Coupons System Routes 

Route::post('/coupon', [CouponsController::class, 'store'])->name('coupon.store');
Route::get('/coupon', [CouponsController::class, 'destroy'])->name('coupon.destroy');



// Cutomer Routes 
Route::get('/', function(){
    return view('dashboard');
});

Route::get('cat', [CategoryController::class, 'index']);

Route::get('CustomerPanel.viewProduct/{id}', [CustomerProduct::class, 'viewProduct'])->name('CustomerPanel.viewProduct');
Route::get('search', [CustomerProduct::class, 'search'])->name('CustomerProduct.search');
Route::post('/addToCart', [CustomerProduct::class, 'addToCart'])->name('addToCart');
Route::get('/CartList', [CustomerProduct::class, 'CartList']);
Route::get('/category/{category}', [CustomerProduct::class, 'show']);
Route::post('/removeFromCart', [CustomerProduct::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/proceedToPayment', [CustomerProduct::class, 'proceedToPayment'])->name('proceedToPayment');
// Route::post('/proceedToPay', [CustomerProduct::class, 'proceedToPay'])->name('proceedToPay');
Route::get('/orderConfirmation/{order_id}', [OrderController::class, 'orderConfirmation'])->name('orderConfirmation');


Route::post('/save-order', [OrderController::class, 'saveOrder'])->name('saveOrder');
// Route::get('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');
Route::get('/order/history', [OrderController::class, 'orderConfirmation'])->name('CustomerPanel.orderConfirmation');
Route::get('/totalOrders', [OrderController::class, 'totalOrders'])->name('totalOrders');
Route::get('/totalRevenue', [OrderController::class, 'totalRevenue'])->name('totalRevenue');



Route::get('/home', [App\Http\Controllers\CustomerProduct::class, 'index'])->name('home');
Route::get('category', [CategoryController::class, 'index']);
Route::get('/welcome', function(){
    return view('welcome');
});

Route::get('/cartshownToCustomer', [AbandonedCartController::class, 'cartshownToCustomer'])->name('cartshownToCustomer');






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

Route::get('/viewOrders', [OrderController::class, 'viewOrders'])->name('viewOrders');





// AbandonedCart Routers 


Route::get('/abandonedCart', [AbandonedCartController::class, 'addToCart'])->name('abandonedCart');
Route::get('/showabandonedCart', [AbandonedCartController::class, 'showAbandonedCart'])->name('showabandonedCart');

Route::get('/viewAbandoned_cart', [AbandonedCartController::class, 'viewAbandonedCart'])->name('viewAbandonedCart');

Route::get('/totalAbandonedCart', [AbandonedCartController::class, 'totalAbandonedCart'])->name('totalAbandonedCart');

Route::get('/removeFromAbandonedCart', [AbandonedCartController::class, 'removeFromAbandonedCart'])->name('removeFromAbandonedCart');


// Order Status 

Route::get('/status', [OrderController::class, 'orderStatus'])->name('orderStatus');
Route::post('/status', [OrderController::class, 'orderStatus'])->name('orderStatus');



Route::get('/count', [CustomerProduct::class, 'count'])->name('count');
