<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== DASHBOARD ====================
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// ==================== COURSES ====================
Route::resource('courses', CourseController::class);

// Route đặc biệt cho Soft Delete (Khôi phục khóa học)
Route::patch('courses/{id}/restore', [CourseController::class, 'restore'])
    ->name('courses.restore');

// ==================== LESSONS ====================
// Lessons thuộc về Course
Route::prefix('courses/{course}')->group(function () {
    Route::resource('lessons', LessonController::class)->except(['index', 'show']);

    // Danh sách bài học của một khóa học
    Route::get('lessons', [LessonController::class, 'indexByCourse'])
        ->name('courses.lessons');

    // Xem chi tiết bài học
    Route::get('lessons/{lesson}', [LessonController::class, 'show'])
        ->name('lessons.show');
});

// ==================== ENROLLMENTS ====================
Route::resource('enrollments', EnrollmentController::class);

// Xem đăng ký theo khóa học
Route::get('courses/{course}/enrollments', [EnrollmentController::class, 'indexByCourse'])
    ->name('courses.enrollments');

// ==================== OPTIONAL ROUTES ====================
// Nếu sau này cần thêm chức năng khôi phục nhiều khóa học hoặc bulk actions
Route::delete('courses/bulk-delete', [CourseController::class, 'bulkDestroy'])->name('courses.bulk.destroy');

// Lessons (tất cả bài học)
Route::get('lessons', [LessonController::class, 'index'])->name('lessons.index');
