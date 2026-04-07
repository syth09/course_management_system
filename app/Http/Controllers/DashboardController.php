<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        $totalEnrollments = Enrollment::count();

        // Doanh thu (giả sử mỗi đăng ký thu giá khóa học)
        $totalRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.price');

        // 5 khóa học mới nhất
        $latestCourses = Course::latest()->take(5)->get();

        // Khóa học có nhiều học viên nhất
        $topCourse = Course::withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->first();

        return view('dashboard.index', compact(
            'totalCourses',
            'totalStudents',
            'totalEnrollments',
            'totalRevenue',
            'latestCourses',
            'topCourse'
        ));
    }
}
