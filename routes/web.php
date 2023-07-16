<?php

use Illuminate\Support\Facades\Route;


//Admin
 Route::group(['prefix' => '/admin','middleware' => ['auth', 'role:admin']], function() {
    Route::get('/dashboard', function(){
        return view('admin.index');
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

Route::get('/', 'App\Http\Controllers\Web\HomeController@index')->name('index');

//Product
Route::get('/san-pham','App\Http\Controllers\Web\ProductController@index')->name('products');
Route::get('/san-pham/{slug}','App\Http\Controllers\Web\ProductController@getListProduct')->name('get-list-product');
Route::get('/chi-tiet-san-pham/{slug}','App\Http\Controllers\Web\ProductController@productDetail')->name('product-detail');
Route::get('/tim-kiem-san-pham','App\Http\Controllers\Web\ProductController@productSearch')->name('product-search');

// News
Route::get('/tin-tuc','App\Http\Controllers\Web\NewsController@index')->name('news');
Route::get('/chi-tiet-bai-viet/{slug}','App\Http\Controllers\Web\NewsController@newsDetail')->name('news-detail');
Route::get('/tim-kiem-tin-tuc','App\Http\Controllers\Web\NewsController@newsSearch')->name('news-search');

//cart
Route::post('add-cart/{id}','App\Http\Controllers\Web\CartController@addCart')->name('add-cart');
Route::get('addCart/{id}', 'App\Http\Controllers\Web\CartController@addCart')->name('add.cart');
Route::get('deleteItemCart/{id}', 'App\Http\Controllers\Web\CartController@deleteItemCart')->name('delete.cart');
Route::get('updateItemCart/{id}/{qty}', 'App\Http\Controllers\Web\CartController@updateItemCart')->name('update.cart');
Route::get('danh-sach-gio-hang', 'App\Http\Controllers\Web\CartController@showListCart')->name('cart-list');

Route::get('gio-hang/thanh-toan', 'App\Http\Controllers\Web\CartController@cartCheckout')->name('cart-checkout');
Route::post('gio-hang/dat-hang', 'App\Http\Controllers\Web\OrderController@createOrder')->name('order');
Route::get('dat-hang-thanh-cong', 'App\Http\Controllers\Web\OrderController@checkoutSuccess')->name('checkout.success');


//Auth

//Comment
Route::post('binh-luan/bai-viet-{id}','App\Http\Controllers\Auth\CommentController@createComment')->name('binh-luan');


//
