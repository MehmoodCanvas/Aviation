<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Login;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Catlog;
use App\Http\Controllers\Front\Main;
use App\Http\Controllers\Front\Ecommerce;











Route::post('/auth',[Login::class,'authenticate']);
Route::get('/logout', [Login::class, 'logout']);
Route::get('/',function(){

    return view('admin.login');
})->name('admin/login');
Route::get('/admin',function(){
    return redirect('admin/dashboard');
});

Route::get('/admin/login',function(){

    return view('admin.login');
})->name('admin/login');
Route::get('/admin',function(){
    return redirect('admin/dashboard');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index']);
    Route::get('/homepage', [Dashboard::class, 'homepage']);
    Route::get('/about', [Dashboard::class, 'about']);
    Route::get('/order', [Dashboard::class, 'order']);
    Route::get('/products', [Dashboard::class, 'products']);
    Route::get('/add-product', [Dashboard::class, 'add_product']);
    Route::get('/orders', [Dashboard::class, 'orders']);
    Route::get('/product-edit/{id}', [Dashboard::class, 'edit_product']);
    Route::get('/order-detail/{id}', [Dashboard::class, 'order_view']);
    Route::get('product-delete/{id}',[Catlog::class,'destroy']);
    Route::get('/global-setting', [Dashboard::class, 'global']);

    //POST METHOD
    Route::post('post-product/',[Catlog::class,'store_product']);
    Route::put('edit-product/{id}',[Catlog::class,'edit_product']);
    Route::put('post-global/{id}',[Home::class,'global_setting']);

});




