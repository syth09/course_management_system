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

    // Đăng ký khóa học (cho phép 1 SV đăng ký nhiều khóa)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
        ]);

        $student = Student::firstOrCreate(
            ['email' => $validated['email']],
            ['name' => $validated['name']]
        );

        // Kiểm tra đã đăng ký khóa này chưa
        $exists = Enrollment::where('course_id', $validated['course_id'])
            ->where('student_id', $student->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Học viên này đã đăng ký khóa học rồi!');
        }

        Enrollment::create([
            'course_id'   => $validated['course_id'],
            'student_id'  => $student->id,
        ]);

        return redirect()->route('enrollments.index')
            ->with('success', 'Đăng ký khóa học thành công!');
    }

    // Xem chi tiết đăng ký
    public function show(Enrollment $enrollment)
    {
        $enrollment->load('course', 'student');
        return view('enrollments.show', compact('enrollment'));
    }

    // Xóa đăng ký (Hủy đăng ký một khóa của học viên)
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
            ->with('success', 'Đã hủy đăng ký khóa học thành công!');
    }

    // ==================== ĐĂNG KÝ THÊM KHÓA HỌC TỪ TRANG CHI TIẾT ====================
    public function addCourseForm(Student $student)
    {
        $courses = Course::published()
            ->whereDoesntHave('students', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->get();

        return view('enrollments.add_course', compact('student', 'courses'));
    }

    public function addCourse(Request $request, Student $student)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $exists = Enrollment::where('course_id', $validated['course_id'])
            ->where('student_id', $student->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Học viên đã đăng ký khóa học này rồi!');
        }

        Enrollment::create([
            'course_id'  => $validated['course_id'],
            'student_id' => $student->id,
        ]);

        return redirect()->route('enrollments.show', $student->enrollments()->latest()->first())
            ->with('success', 'Đăng ký thêm khóa học thành công!');
    }
}
