<?php

use App\Http\Controllers\AllController;
use Illuminate\Support\Facades\Route;

Route::controller(AllController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::post('/','store')->name('store');
    Route::post('/messages','save')->name('messages');
    Route::get('/messages/{target:kode}','messages')->name('viewmes');
});
