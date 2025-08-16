<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Docs\ChangelogController;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'docs');
Route::get('/changelog', [ChangelogController::class, 'changelog']);
Scramble::registerUiRoute('docs');
Scramble::registerJsonSpecificationRoute('api.json');
Route::controller(AuthController::class)->group(function () {
    Route::get('auth/google', 'redirect');
    Route::get('auth/google/callback', 'authenticate');
});
