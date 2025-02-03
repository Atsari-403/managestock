<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

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
    return view('order.product.product');
})->name('order.product.product');