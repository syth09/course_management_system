<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('course', 'student')->latest()->paginate(10);
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $courses = Course::published()->get();
        return view('enrollments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
        ]);

        // Tìm hoặc tạo Student
        $student = Student::firstOrCreate(
            ['email' => $validated['email']],
            ['name' => $validated['name']]
        );

        // Kiểm tra đã đăng ký chưa
        $exists = Enrollment::where('course_id', $validated['course_id'])
            ->where('student_id', $student->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Học viên này đã đăng ký khóa học!');
        }

        Enrollment::create([
            'course_id' => $validated['course_id'],
            'student_id' => $student->id,
        ]);

        return redirect()->route('enrollments.index')
            ->with('success', 'Đăng ký khóa học thành công!');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load('course', 'student');   // Load quan hệ để tránh N+1
        return view('enrollments.show', compact('enrollment'));
    }

    // Hiển thị đăng ký theo khóa học
    public function indexByCourse(Course $course)
    {
        $enrollments = $course->enrollments()->with('student')->get();
        return view('enrollments.index_by_course', compact('course', 'enrollments'));
    }
}
