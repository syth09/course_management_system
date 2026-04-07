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

// Khôi phục khóa học (Soft Delete)
Route::patch('courses/{id}/restore', [CourseController::class, 'restore'])
    ->name('courses.restore');

// ==================== LESSONS ====================
// Lessons thuộc về một khóa học cụ thể
Route::prefix('courses/{course}')->group(function () {
    Route::get('lessons', [LessonController::class, 'indexByCourse'])
        ->name('courses.lessons');

    Route::resource('lessons', LessonController::class)->except(['index']);

    // Xem chi tiết bài học
    Route::get('lessons/{lesson}', [LessonController::class, 'show'])
        ->name('lessons.show');
});

// Danh sách tất cả bài học (nếu cần)
Route::get('lessons', [LessonController::class, 'index'])
    ->name('lessons.index');

// ==================== ENROLLMENTS ====================
Route::resource('enrollments', EnrollmentController::class);

// Xem đăng ký theo khóa học
Route::get('courses/{course}/enrollments', [EnrollmentController::class, 'indexByCourse'])
    ->name('courses.enrollments');

// Đăng ký thêm khóa học cho học viên từ trang chi tiết
Route::get('students/{student}/add-course', [EnrollmentController::class, 'addCourseForm'])
    ->name('enrollments.add.course.form');

Route::post('students/{student}/add-course', [EnrollmentController::class, 'addCourse'])
    ->name('enrollments.add.course');
