<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-citylife', [AboutController::class, 'index'])->name('about');
