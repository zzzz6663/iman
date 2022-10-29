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
Route::get('/clear', 'AdminController@clear');


Route::namespace('admin')->middleware('web')->group(function () {
    Route::post('/check_login', 'AdminController@check_login')->name('admin.check.login');

Route::get('/', 'AdminController@login')->name('login');


});
Route::prefix('admin')->namespace('admin')->middleware(['auth'])->group(function () {
    // login admin
    // Route::get('/agents_all','AdminController@agents_all')->name('admin.agents.all');
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

// //صفحات وب سایت
// Route::get('/', 'HomeController@index')->name('login');
// Route::get('/custom_travel', 'HomeController@custom_travel')->name('custom.travel');



Route::get('/logout', 'HomeController@logout')->name('logout');


