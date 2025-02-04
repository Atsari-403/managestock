<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/profile', function () {
    return view('settings.profile');
})->name('profile');   

Route::get('/reports/daily', function () {
    return view('reports.daily');
})->name('reports.daily');

Route::get('/absensi', function () {
    return view('absenteeism.absenteeism');
})->name('absenteeism.absenteeism');

Route::get('/order', function () {
    return view('order.order');
})->name('order.order');

Route::get('/pulsa', function () {
    return view('order.product.pulsa');
})->name('order.product.product');

Route::get('/e-wallet', function () {
    return view('order.product.e-wallet');
})->name('order.product.e-wallet');

Route::get('/topupgame', function () {
    return view('order.product.topupgame');
})->name('order.product.topupgame');

Route::get('/voucher', function () {
    return view('order.product.voucher');
})->name('order.product.voucher');

Route::get('/accessories', function () {
    return view('order.product.accessories');
})->name('order.product.accessories');

Route::get('/transaksi', function () {
    return view('order.product.transaksi');
})->name('order.product.transaksi');

Route::get('/ppb', function () {
    return view('order.product.ppb');
})->name('order.product.ppb');
