<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MissionsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\BibleSchoolController;
use App\Http\Controllers\BibleSchoolResourceController;
use App\Http\Controllers\SessionAccessController;
use App\Http\Controllers\LeadershipController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-citylife', [AboutController::class, 'index'])->name('about');
Route::get('/leadership', [LeadershipController::class, 'index'])->name('leadership');
Route::get('/missions', [MissionsController::class, 'index'])->name('missions');
Route::get('/events', [EventsController::class, 'index'])->name('events');
Route::get('/events/{slug}', [EventsController::class, 'show'])->name('events.show');
Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::get('/media/{slug}', [MediaController::class, 'show'])->name('media.show');
Route::get('/sermons', [MediaController::class, 'index'])->name('sermons');
Route::get('/resources', [ResourcesController::class, 'index'])->name('resources');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
Route::get('/courses/{slug}', [CoursesController::class, 'show'])->name('courses.show');
Route::get('/bible-school', [BibleSchoolController::class, 'index'])->name('bible-school');
Route::get('/bible-school/resources', [BibleSchoolResourceController::class, 'index'])->name('bible-school.resources');
Route::get('/bible-school/resources/{slug}', [BibleSchoolResourceController::class, 'show'])->name('bible-school.resources.show');
Route::get('/bible-school/resources/{speaker}/{session}', [BibleSchoolResourceController::class, 'play'])->name('bible-school.resources.play');

Route::post('/session-access/send-code', [SessionAccessController::class, 'sendCode'])->name('session-access.send-code');
Route::post('/session-access/verify-code', [SessionAccessController::class, 'verifyCode'])->name('session-access.verify-code');
