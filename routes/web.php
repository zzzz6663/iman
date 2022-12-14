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


Route::namespace('admin')->middleware('web')->group(function () {
    Route::post('/check_login', 'AdminController@check_loegin')->name('admin.check.login');
    Route::get('/clear', 'AdminController@clear');

Route::get('/', 'AdminController@login')->name('login');


});
Route::prefix('admin')->namespace('admin')->middleware(['auth'])->group(function () {
    // login admin
    Route::post('/remove_product/{user}','AdminController@remove_product')->name('remove.product')->middleware(['role:admin']);
    Route::post('/add_product/{user}','AdminController@add_product')->name('add.product')->middleware(['role:admin']);
    Route::get('/client_orders/{user}','ClientController@client_orders')->name('client.orders')->middleware(['role:branch|admin']);
    Route::post('/get_product/{brand}','ClientController@get_product')->name('get.product')->middleware(['role:client']);
    Route::any('/pass_products/{user}','AdminController@pass_products')->name('pass.products')->middleware(['role:admin']);
    Route::any('/branch_products','BranchController@branch_products')->name('branch.products')->middleware(['role:branch']);
    Route::any('/pass_traffic_code/{product}','BranchController@pass_traffic_code')->name('pass.traffic.code')->middleware(['role:branch']);
    // Route::post('/sub_cat_list/{category}', 'CategoryController@sub_cat_list')->middleware(['role:admin']);
    // Route::resource('category', 'CategoryController')->middleware(['role:admin']);
    Route::resource('branch', 'BranchController')->middleware(['role:admin']);
    Route::any('/edit_company', 'StaffController@edit_company')->name('edit.company')->middleware(['role:admin']);
    Route::resource('staff', 'StaffController')->middleware(['role:admin']);
    Route::resource('supplier', 'SupplierController')->middleware(['role:admin']);
    Route::resource('client', 'ClientController')->middleware(['role:admin|branch']);
    Route::resource('brand', 'BrandController')->middleware(['role:admin']);
    Route::resource('order', 'OrderController')->middleware(['role:client|admin']);
    Route::resource('supplier', 'SupplierController')->middleware(['role:admin']);
    Route::resource('product', 'ProductController')->middleware(['role:admin']);

    // Route::post('/new_adventure', 'UserController@new_adventure')->name('user.new.adventure');
});




// Route::post('/check_password', 'HomeController@check_password');
// Route::post('/update_password', 'HomeController@update_password');
// Route::post('/check_code', 'HomeController@check_code');
// Route::post('/resend_code', 'HomeController@resend_code');
// Route::post('/check_user_exist', 'HomeController@check_user_exist');
// Route::post('/reload_captcha', 'HomeController@reload_captcha')->name('reload.captcha');

// Route::post('/get_city/{province}', 'HomeController@get_city');
// Route::get('/clear', 'HomeController@clear')->name('clear');

// //?????????? ???? ????????
// Route::get('/', 'HomeController@index')->name('login');
// Route::get('/custom_travel', 'HomeController@custom_travel')->name('custom.travel');



Route::get('/logout', 'HomeController@logout')->name('logout');


