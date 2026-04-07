@extends('layouts.app')

@section('title', 'Thêm Bài Học Mới')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Thêm Bài Học Mới cho khóa: {{ $course->name }}</h2>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('lessons.store', $course) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tiêu đề bài học <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nội dung bài học</label>
                        <textarea name="content" class="form-control " rows="6">{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Video (YouTube, Vimeo...)</label>
                        <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Thứ tự hiển thị <span class="text-danger">*</span></label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}"
                            min="1" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Thêm bài học</button>
                        <a href="{{ route('courses.lessons', $course) }}" class="btn btn-secondary btn-lg px-5">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
