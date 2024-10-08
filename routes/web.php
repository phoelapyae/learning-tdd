<?php

use App\Http\Controllers\CourseVideosController;
use App\Http\Controllers\PageCourseDetailsController;
use App\Http\Controllers\PageDashboardController;
use App\Http\Controllers\PageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', PageHomeController::class)->name('pages.home');

Route::get('course-details/{course:slug}', PageCourseDetailsController::class)->name('pages.course-details');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', PageDashboardController::class)->name('page.dashboard');
    Route::get('/videos/{course:slug}/{video:slug?}', CourseVideosController::class)->name('page.course-videos');
});