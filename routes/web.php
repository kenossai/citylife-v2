<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MissionsController;
use App\Http\Controllers\MediaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-citylife', [AboutController::class, 'index'])->name('about');
Route::get('/missions', [MissionsController::class, 'index'])->name('missions');
Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::get('/sermons', [MediaController::class, 'index'])->name('sermons');
