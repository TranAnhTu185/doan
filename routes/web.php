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
    Route::post('them', 'CartController@addCart')->name('home.cart.add');
    Route::get('sua', 'CartController@changeQuantity')->name('home.cart.change');
    Route::get('xoa', 'CartController@removeInCart')->name('home.cart.delete');
    Route::get('/', 'CartController@viewCart')->name('home.cart');
});
//checkout
Route::get('thanh-toan.html', 'HomeController@checkout')->name('home.checkout');
Route::post('thanh-toan.html', 'HomeController@storeBill')->name('home.checkout.store');
Route::get('dat-hang-thanh-cong.html', 'HomeController@confirmOder')->name('home.checkout.success');
Route::get('lich-su-don-hang.html', 'HomeController@historyOder')->name('home.checkout.history');
//login & register
Route::get('dang-nhap.html', 'HomeController@loginpage')->name('home.loginpage');
Route::post('dang-nhap.html', 'HomeController@login')->name('home.login');
Route::post('dang-ky.html', 'HomeController@register')->name('home.register');
Route::get('dang-xuat.html', 'HomeController@logout')->name('home.logout');
Route::get('doi-mat-khau.html', 'HomeController@changePage')->name('home.change-page');
Route::post('doi-mat-khau.html', 'HomeController@changePass')->name('home.change-pass');
//search
Route::get('tim-kiem.html','HomeController@search')->name('home.search');
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
            Route::get('destroy/{id}', 'Admin\ProductController@destroy')->name('admin.product.destroy');
        });

        //customer
        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', 'Admin\CustomerController@index')->name('admin.customer');
            Route::get('create', 'Admin\CustomerController@create')->name('admin.customer.create');
            Route::post('store', 'Admin\CustomerController@store')->name('admin.customer.store');
            Route::get('edit/{id}', 'Admin\CustomerController@edit')->name('admin.customer.edit');
            Route::post('update/{id}', 'Admin\CustomerController@update')->name('admin.customer.update');
            Route::get('show/{id}', 'Admin\CustomerController@show')->name('admin.customer.show');
            Route::get('destroy/{id}', 'Admin\CustomerController@destroy')->name('admin.customer.destroy');
        });

        //bill
        Route::group(['prefix' => 'bill'], function () {
            Route::get('/','Admin\BillController@index')->name('admin.bill');
            Route::get('/new','Admin\BillController@newBill')->name('admin.bill.new');
            Route::get('create', 'Admin\BillController@create')->name('admin.bill.create');
            Route::post('store', 'Admin\BillController@store')->name('admin.bill.store');
            Route::get('edit/{id}', 'Admin\BillController@edit')->name('admin.bill.edit');
            Route::post('update/{id}', 'Admin\BillController@update')->name('admin.bill.update');
            Route::get('show/{id}', 'Admin\BillController@show')->name('admin.bill.show');
            Route::get('destroy/{id}', 'Admin\BillController@destroy')->name('admin.bill.destroy');
            Route::get('delete', 'Admin\BillController@delete')->name('admin.bill.delete');
            Route::get('search', 'Admin\BillController@searchProduct')->name('admin.bill.search');
            Route::get('select', 'Admin\BillController@selectProduct')->name('admin.bill.select');
            Route::post('add', 'Admin\BillController@addProduct')->name('admin.bill.add');
            Route::get('search-customer', 'Admin\BillController@searchCustomer')->name('admin.bill.search-customer');
            Route::get('select-customer', 'Admin\BillController@selectCustomer')->name('admin.bill.select-customer');
            Route::get('payment', 'Admin\BillController@getPayment')->name('admin.bill.payment');
            Route::post('add-payment', 'Admin\BillController@addPayment')->name('admin.bill.add-payment');
            Route::get('edit-payment/{id}', 'Admin\BillController@editPayment')->name('admin.bill.edit-payment');
            Route::post('update-payment', 'Admin\BillController@updatePayment')->name('admin.bill.update-payment');
            Route::get('delete-payment/{id}', 'Admin\BillController@deletePayment')->name('admin.bill.delete-payment');
        });

        //news
        Route::group(['prefix' => 'news'], function () {
            Route::get('/', 'Admin\NewsController@index')->name('admin.news');
            Route::get('create', 'Admin\NewsController@create')->name('admin.news.create');
            Route::post('store', 'Admin\NewsController@store')->name('admin.news.store');
            Route::get('edit/{id}', 'Admin\NewsController@edit')->name('admin.news.edit');
            Route::post('update/{id}', 'Admin\NewsController@update')->name('admin.news.update');
            Route::get('destroy/{id}', 'Admin\NewsController@destroy')->name('admin.news.destroy');
        });

        //user
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'Admin\UserController@index')->name('admin.user');
            Route::get('create', 'Admin\UserController@create')->name('admin.user.create');
            Route::post('store', 'Admin\UserController@store')->name('admin.user.store');
            Route::get('edit/{id}', 'Admin\UserController@edit')->name('admin.user.edit');
            Route::post('update/{id}', 'Admin\UserController@update')->name('admin.user.update');
            Route::get('show/{id}', 'Admin\UserController@show')->name('admin.user.show');
            Route::get('destroy/{id}', 'Admin\UserController@destroy')->name('admin.user.destroy');
        });

        //catagory
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'Admin\CategoryController@index')->name('admin.category');
            Route::post('store', 'Admin\CategoryController@store')->name('admin.category.store');
            Route::get('edit/{id}', 'Admin\CategoryController@edit')->name('admin.category.edit');
            Route::post('update/{id}', 'Admin\CategoryController@update')->name('admin.category.update');
            Route::get('destroy/{id}', 'Admin\CategoryController@destroy')->name('admin.category.destroy');
        });

        //slideshow
        Route::group(['prefix' => 'slide'], function () {
            Route::get('/', 'Admin\SettingController@slideshow')->name('admin.slide');
            Route::post('store', 'Admin\SettingController@storeSlide')->name('admin.slide.store');
            Route::get('destroy/{id}', 'Admin\SettingController@destroySlide')->name('admin.slide.destroy');
        });

        //contact
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', 'Admin\SettingController@contact')->name('admin.contact');
            Route::post('store', 'Admin\SettingController@storeContact')->name('admin.contact.store');
            Route::post('create', 'Admin\SettingController@createContact')->name('admin.contact.create');
            Route::post('update/{id}', 'Admin\SettingController@updateContact')->name('admin.contact.update');
        });
    });
});
