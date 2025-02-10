<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PacketCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'loginform'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest', 'throttle:5,1');
Route::post('logout', LogOutController::class)->name('logout')->middleware('auth');
Route::middleware('auth')->group(function(){
    Route::get('users/setting/{id}', [ProfileController::class, 'edit'])->name('setting');
    Route::match(['post', 'put'], 'users/setting/{id}', [ProfileController::class, 'update'])->name('setting.update');
    Route::get('order/index',[OrderController::class, 'index'])->name('indexorder');
});
Route::middleware(['isAdmin', 'auth'])->group(function(){
    Route::get('users', [UserController::class, 'index'])->name('indexuser');
    Route::get('user/create', [UserController::class, 'create'])->name('createuser');
    Route::get('user/create', [UserController::class, 'email'])->name('createuser');
    Route::post('user/create', [UserController::class, 'store'])->name('createuser');
    Route::get('user/show/{id}', [UserController::class, 'show'])->name('showuser');
    Route::get('users/edit',[UserController::class,'edit'])->name('useredit');


    Route::get('product/create',[ProductController::class, 'create'])->name('createproduct');
    Route::get('product',[ProductController::class,'index'])->name('productindex');
    route::get('product/category/index/{idProduct}',[CategoryProductController::class,'index'])->name('indexcategoryproduct');
    Route::get('product/category/create/{idProduct}',[CategoryProductController::class,'create'])->name('categoryproductcreate');
    Route::post('product/category/create/{idProduct}',[CategoryProductController::class,'store'])->name('categoryproductstore');
    Route::delete('product/category/destroy/{category_product_id}',[CategoryProductController::class,'destroy'])->name('categoryproductdestroy');
    
    Route::get('product/category/paket/index/{category_product_id}',[PacketCategoryController::class,'index'])->name('indexpaket');
    Route::post('product/category/paket/store',[PacketCategoryController::class,'store'])->name('storepaket');
    Route::delete('product/category/paket/destroy/{id}',[PacketCategoryController::class,'destroy'])->name('destroypaket');


});
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard')->middleware('auth');



Route::get('/reports/daily', function () {
    return view('reports.daily');
})->name('reports.daily')->middleware('auth');

Route::get('/absensi', function () {
    return view('absenteeism.absenteeism');
})->name('absenteeism.absenteeism')->middleware('auth');



Route::get('/pulsa', function () {
    return view('order.product.pulsa');
})->name('Pulsa')->middleware('auth');

Route::get('/e-wallet', function () {
    return view('order.product.e-wallet');
})->name('E-Wallet')->middleware('auth');

Route::get('/topupgame', function () {
    return view('order.product.topupgame');
})->name('Top Up Game')->middleware('auth');

Route::get('/voucher', function () {
    return view('order.product.voucher');
})->name('Voucher')->middleware('auth');

Route::get('/accessories', function () {
    return view('order.product.accessories');
})->name('Aksesoris')->middleware('auth');

Route::get('/transaksi', function () {
    return view('order.product.transaksi');
})->name('Transaksi')->middleware('auth');

Route::get('/ppb', function () {
    return view('order.product.ppb');
})->name('Pembayaran Pascabayar')->middleware('auth');
