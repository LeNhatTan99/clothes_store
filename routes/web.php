<?php

use Illuminate\Support\Facades\Route;


Route::get('test', function(){
return view('frontend.carts.cart-checkout');
});
//Admin
Route::group(['prefix' => '/admin','middleware' => ['auth', 'role:user']], function() {
    Route::get('/', function(){
        return view('backend.app');
    })->name('admin');
    Route::resource('users','App\Http\Controllers\Admin\UserController');
    Route::resource('roles','App\Http\Controllers\Admin\RoleController');
    Route::resource('permissions','App\Http\Controllers\Admin\PermissionController');
    Route::resource('categories','App\Http\Controllers\Admin\CategoryController');
    Route::resource('products','App\Http\Controllers\Admin\ProductController');
    Route::get('search','App\Http\Controllers\Admin\ProductController@Search')->name('admin.search');
    Route::resource('orders','App\Http\Controllers\Admin\OrderController');
    Route::resource('news','App\Http\Controllers\Admin\NewsController');
});

Auth::routes();

//Public

Route::get('/', 'App\Http\Controllers\Public\HomeController@index')->name('index');

//Product
Route::get('/san-pham','App\Http\Controllers\Public\ProductController@index')->name('products');
Route::get('/san-pham/{slug}','App\Http\Controllers\Public\ProductController@getListProduct')->name('get-list-product');
Route::get('/chi-tiet-san-pham/{slug}','App\Http\Controllers\Public\ProductController@productDetail')->name('product-detail');
Route::get('/tim-kiem-san-pham','App\Http\Controllers\Public\ProductController@productSearch')->name('product-search');

// News
Route::get('/tin-tuc','App\Http\Controllers\Public\NewsController@index')->name('news');
Route::get('/chi-tiet-bai-viet/{slug}','App\Http\Controllers\Public\NewsController@newsDetail')->name('news-detail');
Route::get('/tim-kiem-tin-tuc','App\Http\Controllers\Public\NewsController@newsSearch')->name('news-search');


//cart
Route::post('add-cart/{id}','App\Http\Controllers\Public\CartController@addCart')->name('add-cart');
Route::get('addCart/{id}', 'App\Http\Controllers\Public\CartController@addCart')->name('add.cart');
Route::get('deleteItemCart/{id}', 'App\Http\Controllers\Public\CartController@deleteItemCart')->name('delete.cart');
Route::get('updateItemCart/{id}/{qty}', 'App\Http\Controllers\Public\CartController@updateItemCart')->name('update.cart');
Route::get('danh-sach-gio-hang', 'App\Http\Controllers\Public\CartController@showListCart')->name('cart-list');

Route::get('gio-hang/thanh-toan', 'App\Http\Controllers\Public\CartController@cartCheckout')->name('cart-checkout');
Route::post('gio-hang/dat-hang', 'App\Http\Controllers\Public\OrderController@createOrder')->name('order');
Route::post('gio-hang/thanh-toan-vnpay', 'App\Http\Controllers\Public\OrderController@vnpayPayment')->name('vnpay-payment');
Route::get('cart/order/checkout-success', 'App\Http\Controllers\Public\OrderController@checkoutSuccess')->name('checkout.success');


//Auth

//Comment
Route::post('binh-luan/bai-viet-{id}','App\Http\Controllers\Auth\CommentController@createComment')->name('binh-luan');


//
