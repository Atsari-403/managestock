<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PacketCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'loginform'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest', 'throttle:5,1');
Route::middleware('auth')->group(function () {
    Route::post('logout', LogOutController::class)->name('logout');
    Route::get('users/setting/{id}', [ProfileController::class, 'edit'])->name('setting');
    Route::match(['post', 'put'], 'users/setting/{id}', [ProfileController::class, 'update'])->name('setting.update');
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('order/index', [OrderController::class, 'indexProduct'])->name('indexorder');
    Route::get('order/category/{idProduct}', [OrderController::class, 'indexCategory'])->name('categoryorder');
    Route::get('order/packet/{idProduct}/{idCategory}', [OrderController::class, 'indexPacket'])->name('packetorder');
    Route::post('/product/category/paket/order', [OrderController::class, 'store'])->name('Order');
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('/attendance/{action}', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/izin', [AttendanceController::class, 'izin'])->name('attendance.izin');
});
Route::middleware(['isAdmin', 'auth'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('indexuser');
    Route::get('user/create', [UserController::class, 'create'])->name('createuser');
    Route::get('user/create', [UserController::class, 'email'])->name('createuser');
    Route::post('user/create', [UserController::class, 'store'])->name('createuser');
    Route::get('user/show/{id}', [UserController::class, 'show'])->name('showuser');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('useredit');
    Route::post('users/edit/{id}', [UserController::class, 'update'])->name('userupdate');
    Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('userdestroy');

    Route::get('order/index/{store_id}', [OrderController::class, 'indexProductAdmin'])->name('indexorderAdmin');

    route::get('product/category/index/{idProduct}', [CategoryProductController::class, 'index'])->name('indexcategoryproduct');
    Route::get('product/category/create/{idProduct}', [CategoryProductController::class, 'create'])->name('categoryproductcreate');
    Route::post('product/category/create/{idProduct}', [CategoryProductController::class, 'store'])->name('categoryproductstore');
    Route::delete('product/category/destroy/{category_product_id}', [CategoryProductController::class, 'destroy'])->name('categoryproductdestroy');
    Route::post('product/category/update/{idProduct}', [CategoryProductController::class, 'update'])->name('categoryproductupdate');

    Route::get('product/category/paket/index/{idProduct}/{category_product_id}', [PacketCategoryController::class, 'index'])->name('indexpaket');
    Route::post('product/category/paket/store', [PacketCategoryController::class, 'store'])->name('storepaket');
    Route::delete('product/category/paket/destroy/{id}', [PacketCategoryController::class, 'destroy'])->name('destroypaket');
    Route::post('product/category/paket/update/{id}', [PacketCategoryController::class, 'update'])->name('updatepaket');

    Route::post('/product/category/paket/add-stock/{id}', [StockController::class, 'addStock']);

    // history
    Route::get('/product/category/paket/history-stock', [StockController::class, 'index'])->name('historyStock');
    Route::get('product/order-history', [OrderController::class, 'indexOrder'])->name('historyOrder');
    // Route::get('matahari/test',[OrderController::class,'indexOrder'])->name('test');

    Route::get('product/create', [ProductController::class, 'create'])->name('createproduct');
    Route::get('product/{store_id}', [ProductController::class, 'index'])->name('productindex');


    //store route
    Route::get('/store/create', [StoreController::class, 'create'])->name('storeCreate');
    Route::post('/store/create', [StoreController::class, 'store'])->name('storeStore');
    Route::delete('/store/destroy/{id}', [StoreController::class, 'destroy'])->name('storeDestroy');
    Route::get('/store/index', [OrderController::class, 'indexStore'])->name('indexStore');
});
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/reports/daily', function () {
    return view('reports.daily');
})->name('reports.daily')->middleware('auth');

Route::get('/absensi', function () {
    return view('absenteeism.absenteeism');
})->name('absenteeism.absenteeism')->middleware('auth');
