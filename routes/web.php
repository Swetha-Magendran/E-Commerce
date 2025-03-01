<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Backend Code Here

Route::get('/admin_login', [AdminController::class, 'login'])->name('admin_login');

Route::post('/login_authentication', [LoginController::class, 'login_authentication'])->name('login_authentication');

Route::middleware('backend')->group( function() 
{

    Route::get('/admin_index', [AdminController::class, 'index'])->name('admin_index');

    Route::get('/category', [AdminController::class, 'category'])->name('category');

    Route::get('/sub_category', [AdminController::class, 'sub_category'])->name('sub_category');

    Route::get('/product', [AdminController::class, 'product'])->name('product');

    Route::post('/category_store', [AdminController::class, 'category_store'])->name('category_store');

    Route::get('/get_category', [AdminController::class, 'get_category'])->name('get_category');

    Route::post('/sub_category_store', [AdminController::class, 'sub_category_store'])->name('sub_category_store');

    Route::get('/get_sub_category',[AdminController::class,'get_sub_category'])->name('get_sub_category');

    Route::post('/product_store', [AdminController::class, 'product_store'])->name('product_store');

    Route::get('/measurment', [AdminController::class, 'measurment'])->name('measurment');

    Route::post('/measurment_store', [AdminController::class, 'measurment_store'])->name('measurment_store');

    Route::get('/get_product', [AdminController::class, 'get_product'])->name('get_product');

    Route::get('/user_details', [AdminController::class, 'user_details'])->name('user_details');

    Route::get('/delete_user_details', [AdminController::class, 'delete_user_details'])->name('delete_user_details');

    Route::get('/order_details', [AdminController::class, 'order_details'])->name('order_details');

    Route::get('/delete_order_details', [AdminController::class, 'delete_order_details'])->name('delete_order_details');

    Route::get('/authentication', [AdminController::class, 'authentication'])->name('authentication');

    Route::post('/login_authority', [RegisterController::class, 'login_authority'])->name('login_authority');

    Route::get('/get_authentication', [AdminController::class, 'get_authentication'])->name('get_authentication');

    Route::get('admin_logout', [LoginController::class, 'admin_logout'])->name('admin_logout');

    Route::get('stock', [AdminController::class, 'stock'])->name('stock');

    Route::post('stock_entry', [AdminController::class, 'stock_entry'])->name('stock_entry');

    Route::get('get_product_code', [AdminController::class, 'get_product_code'])->name('get_product_code');

    Route::get('get_stock', [AdminController::class, 'get_stock'])->name('get_stock');

    Route::get('delete_stock', [AdminController::class, 'delete_stock'])->name('delete_stock');

    Route::get('user_list', [AdminController::class , 'user_list'])->name('user_list');

});

//Frontend Code Here
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [HomeController::class, 'shop'])->name('shop');

Route::get('/get_product_details/{product_id}', [HomeController::class, 'get_product_details']);

Route::get('/user_profile', [HomeController::class, 'user_profile'])->name('user_profile');

Route::post('/user_register', [RegisterController::class, 'store'])->name('store');

Route::get('login', [HomeController::class, 'login'])->name('login');

Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/get_category_wise_product', [HomeController::class, 'get_category_wise_product'])->name('get_category_wise_products');

Route::get('/get_sub_category_wise_product', [HomeController::class, 'get_sub_category_wise_product'])->name('get_sub_category_wise_product');

Route::get('/get_price_wise_product', [HomeController::class, 'get_price_wise_product'])->name('get_price_wise_product');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('frontend')->group( function() 
{
    
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

    Route::get('/add_to_cart', [HomeController::class, 'add_to_cart'])->name('add_to_cart');

    Route::get('/update_cart_item', [HomeController::class, 'update_cart_item'])->name('update_cart_item');

    Route::get('/delete_cart_item', [HomeController::class, 'delete_cart_item'])->name('delete_cart_item');

    Route::post('/store_order_details', [HomeController::class, 'store_order_details'])->name('place_order');

    Route::get('/handle-payment',[PaypalController::class, 'handlePayment'])->name('make.payment');

    Route::get('payment-success', [PaypalController::class, 'paymentSuccess'])->name('payment.success');

    Route::get('payment-failed', [PaypalController::class, 'paymentFailed'])->name('payment.failed');

    Route::get('/user_order_details', [HomeController::class, 'order_details'])->name('user_order_details');

});




