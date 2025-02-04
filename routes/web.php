<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'loginform'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('logout', LogOutController::class)->name('logout')->middleware('auth');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard')->middleware('auth');

Route::get('/profile', function () {
    return view('settings.profile');
})->name('profile')->middleware('auth');

Route::get('/reports/daily', function () {
    return view('reports.daily');
})->name('reports.daily')->middleware('auth');

Route::get('/absensi', function () {
    return view('absenteeism.absenteeism');
})->name('absenteeism.absenteeism')->middleware('auth');

Route::get('/order', function () {
    return view('order.order');
})->name('order.order')->middleware('auth');

Route::get('/pulsa', function () {
    return view('order.product.product');
})->name('order.product.product')->middleware('auth');

Route::get('/order', function () {
    return view('order.order');
})->name('order.order')->middleware('auth');

Route::get('/pulsa', function () {
    return view('order.product.pulsa');
})->name('order.product.product')->middleware('auth');

Route::get('/e-wallet', function () {
    return view('order.product.e-wallet');
})->name('order.product.e-wallet')->middleware('auth');

Route::get('/topupgame', function () {
    return view('order.product.topupgame');
})->name('order.product.topupgame')->middleware('auth');

Route::get('/voucher', function () {
    return view('order.product.voucher');
})->name('order.product.voucher')->middleware('auth');

Route::get('/accessories', function () {
    return view('order.product.accessories');
})->name('order.product.accessories')->middleware('auth');

Route::get('/transaksi', function () {
    return view('order.product.transaksi');
})->name('order.product.transaksi')->middleware('auth');

Route::get('/ppb', function () {
    return view('order.product.ppb');
})->name('order.product.ppb')->middleware('auth');
