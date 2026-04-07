<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // Hiển thị bài học theo khóa học
    public function indexByCourse(Course $course)
    {
        $lessons = $course->lessons()->orderBy('order')->get();
        return view('lessons.index', compact('course', 'lessons'));
    }

    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'video_url'  => 'nullable|url',
            'order'      => 'required|integer|min:1',
        ]);

        $validated['course_id'] = $course->id;

        Lesson::create($validated);

        return redirect()->route('courses.lessons', $course)
            ->with('success', 'Thêm bài học thành công!');
    }

    public function edit(Course $course, Lesson $lesson)
    {
        return view('lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'video_url'  => 'nullable|url',
            'order'      => 'required|integer|min:1',
        ]);

        $lesson->update($validated);

        return redirect()->route('courses.lessons', $course)
            ->with('success', 'Cập nhật bài học thành công!');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('courses.lessons', $course)
            ->with('success', 'Xóa bài học thành công!');
    }
}
