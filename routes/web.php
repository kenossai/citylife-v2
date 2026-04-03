<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MissionsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\BibleSchoolController;
use App\Http\Controllers\BibleSchoolResourceController;
use App\Http\Controllers\Member\MemberAuthController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Member\MemberLessonController;
use App\Http\Controllers\Member\MemberSettingsController;
use App\Http\Controllers\SessionAccessController;
use App\Http\Controllers\GivingController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\MinistryController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/give', [GivingController::class, 'index'])->name('give');
Route::post('/give/gift-aid', [GivingController::class, 'storeGiftAid'])->name('give.gift-aid');
Route::get('/about-citylife', [AboutController::class, 'index'])->name('about');
Route::get('/leadership', [LeadershipController::class, 'index'])->name('leadership');
Route::get('/our-ministries', [MinistryController::class, 'index'])->name('ministries');
Route::get('/our-ministries/{slug}', [MinistryController::class, 'show'])->name('ministries.show');
Route::get('/missions', [MissionsController::class, 'index'])->name('missions');
Route::get('/events', [EventsController::class, 'index'])->name('events');
Route::get('/events/{slug}', [EventsController::class, 'show'])->name('events.show');
Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::get('/media/{slug}', [MediaController::class, 'show'])->name('media.show');
Route::get('/sermons', [MediaController::class, 'index'])->name('sermons');
Route::get('/books', [BooksController::class, 'index'])->name('books.index');
Route::get('/books/{slug}', [BooksController::class, 'show'])->name('books.show');
Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
Route::get('/courses/{slug}', [CoursesController::class, 'show'])->name('courses.show');
Route::post('/courses/{slug}/enrol', [CoursesController::class, 'enrol'])->name('courses.enrol');
Route::get('/bible-school', [BibleSchoolController::class, 'index'])->name('bible-school');
Route::get('/bible-school/resources', [BibleSchoolResourceController::class, 'index'])->name('bible-school.resources');
Route::get('/bible-school/resources/{slug}', [BibleSchoolResourceController::class, 'show'])->name('bible-school.resources.show');
Route::get('/bible-school/resources/{speaker}/{session}', [BibleSchoolResourceController::class, 'play'])->name('bible-school.resources.play');

Route::post('/session-access/send-code', [SessionAccessController::class, 'sendCode'])->name('session-access.send-code');
Route::post('/session-access/verify-code', [SessionAccessController::class, 'verifyCode'])->name('session-access.verify-code');

Route::prefix('member')->name('member.')->group(function () {
    Route::get('/login', [MemberAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [MemberAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

    // Password setup (one-time link from approval email)
    Route::get('/setup-password/{token}', [MemberAuthController::class, 'showSetupPassword'])->name('setup-password.show');
    Route::post('/setup-password/{token}', [MemberAuthController::class, 'setupPassword'])->name('setup-password.store');

    Route::middleware('member.auth')->group(function () {
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        Route::get('/my-courses', [MemberDashboardController::class, 'courses'])->name('courses');
        Route::get('/progress', [MemberDashboardController::class, 'progress'])->name('progress');
        Route::get('/certificates', [MemberDashboardController::class, 'certificates'])->name('certificates');
        Route::get('/certificates/{enrollmentId}', [MemberDashboardController::class, 'certificateDetail'])->name('certificates.view');

        // Settings
        Route::get('/settings', [MemberSettingsController::class, 'show'])->name('settings');
        Route::post('/settings/avatar', [MemberSettingsController::class, 'updateAvatar'])->name('settings.avatar');
        Route::patch('/settings/profile', [MemberSettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::patch('/settings/password', [MemberSettingsController::class, 'updatePassword'])->name('settings.password');
        Route::patch('/settings/notifications', [MemberSettingsController::class, 'updateNotifications'])->name('settings.notifications');
        Route::delete('/settings/account', [MemberSettingsController::class, 'deleteAccount'])->name('settings.delete-account');

        // Lesson viewer
        Route::get('/courses/{courseSlug}/lessons/{lessonSlug}', [MemberLessonController::class, 'show'])->name('lesson.show');
        Route::post('/courses/{courseSlug}/lessons/{lessonSlug}/mark-read', [MemberLessonController::class, 'markRead'])->name('lesson.mark-read');
        Route::post('/courses/{courseSlug}/lessons/{lessonSlug}/notes', [MemberLessonController::class, 'saveNotes'])->name('lesson.notes');
        Route::get('/courses/{courseSlug}/lessons/{lessonSlug}/notes', [MemberLessonController::class, 'notesPage'])->name('lesson.notes-page');
        Route::post('/courses/{courseSlug}/lessons/{lessonSlug}/notes', [MemberLessonController::class, 'saveNotes'])->name('lesson.notes');
        Route::get('/courses/{courseSlug}/lessons/{lessonSlug}/quiz', [MemberLessonController::class, 'quizPage'])->name('lesson.quiz-page');
        Route::post('/courses/{courseSlug}/lessons/{lessonSlug}/quiz', [MemberLessonController::class, 'submitQuiz'])->name('lesson.quiz');
    });
});
