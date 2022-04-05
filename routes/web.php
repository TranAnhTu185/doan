<?php

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/trang-chu.html', 'HomeController@index')->name('home.index');
//list product
Route::get('danh-sach/{id}-{name}.html', 'HomeController@getList')->name('home.list');
//detail product
Route::get('chi-tiet/{id}-{name}.html', 'HomeController@getDetail')->name('home.detail');
Route::get('xem-nhanh', 'HomeController@quickView')->name('home.quickview');
//cart
Route::group(['prefix' => 'gio-hang'], function () {
        Route::get('hien-thi','CartController@getCart')->name('home.cart.get');
        Route::post('them', 'CartController@addCart')->name('home.cart.add')->middleware('customer');
        Route::get('xoa', 'CartController@removeInCart')->name('home.cart.delete')->middleware('customer');
        Route::get('/', 'CartController@viewCart')->name('home.cart')->middleware('customer');
});
//checkout
Route::get('thanh-toan.html', 'HomeController@checkout')->name('home.checkout');
Route::post('thanh-toan.html', 'HomeController@storeBill')->name('home.checkout.store')->middleware('customer');
Route::get('dat-hang-thanh-cong.html', 'HomeController@confirmOder')->name('home.checkout.success');
Route::get('lich-su-don-hang.html', 'HomeController@historyOder')->name('home.checkout.history');
//login & register
Route::get('dang-nhap.html', 'HomeController@loginpage')->name('home.loginpage');
Route::post('dang-nhap.html', 'HomeController@login')->name('home.login');
Route::post('dang-ky.html', 'HomeController@register')->name('home.register');
Route::get('dang-xuat.html', 'HomeController@logout')->name('home.logout');

//contact
Route::get('lien-he.html', 'HomeController@contact')->name('home.contact');

Route::group(['prefix' => 'admin'], function () {
    //login && logout
    Route::get('login', 'Admin\HomeController@loginpage')->name('admin.loginpage');
    Route::post('login', 'Admin\HomeController@login')->name('admin.login');
    Route::get('logout', 'Admin\HomeController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:web']], function () {
        //dashboard
        Route::get('/', 'Admin\HomeController@index')->name('admin.home');

        //product
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'Admin\ProductController@index')->name('admin.product');
            Route::get('create', 'Admin\ProductController@create')->name('admin.product.create');
            Route::post('store', 'Admin\ProductController@store')->name('admin.product.store');
            Route::get('edit/{id}', 'Admin\ProductController@edit')->name('admin.product.edit');
            Route::post('update/{id}', 'Admin\ProductController@update')->name('admin.product.update');
            Route::get('comment/{id}', 'Admin\ProductController@showComment')->name('admin.comment');
            Route::get('comment/delete/{id}', 'Admin\ProductController@deleteCommentProduct')->name('admin.comment.delete');
        });
    });
});
