<?php

use App\Http\Controllers\AllController;
use Illuminate\Support\Facades\Route;

Route::controller(AllController::class)->group(function () {
    Route::get('send', 'sendCode');
    Route::match(['get', 'post'], '/login', 'login')->name('login')->middleware('guest');
    Route::match(['get', 'post'], '/', 'home')->name('home')->middleware('auth');
    Route::get('logout', 'logout')->name('logout')->middleware('auth');
    Route::get('{code}', [AllController::class, 'withCode']);
    Route::get('p/{code}', [AllController::class, 'withMessage'])->name('mess');
});
