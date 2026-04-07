@extends('layouts.app')

@section('title', 'Sửa Bài Học')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Sửa Bài Học: {{ $lesson->title }}</h2>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('lessons.update', [$course, $lesson]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tiêu đề bài học</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $lesson->title) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nội dung bài học</label>
                        <textarea name="content" class="form-control" rows="6">{{ old('content', $lesson->content) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Video</label>
                        <input type="url" name="video_url" class="form-control"
                            value="{{ old('video_url', $lesson->video_url) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Thứ tự hiển thị</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $lesson->order) }}"
                            min="1" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning btn-lg px-5">Cập nhật bài học</button>
                        <a href="{{ route('courses.lessons', $course) }}" class="btn btn-secondary btn-lg px-5">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
