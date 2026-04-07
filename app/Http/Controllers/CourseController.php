<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::withCount('lessons', 'enrollments');

        // Tìm kiếm
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sắp xếp
        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('price', 'asc'),
                'price_desc' => $query->orderBy('price', 'desc'),
                'students_desc' => $query->orderByDesc('enrollments_count'),
                default => $query->latest(),
            };
        } else {
            $query->latest();
        }

        $courses = $query->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Thêm khóa học thành công!');
    }

    public function show(Course $course)
    {
        $course->load('lessons', 'enrollments.student');
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')
            ->with('success', 'Cập nhật khóa học thành công!');
    }

    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được chuyển vào thùng rác!');
    }

    // Soft Delete - Khôi phục
    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được khôi phục!');
    }
}
