@extends('layouts.app')

@section('title', 'Chi tiết Bài Học')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Chi tiết Bài Học</h2>
            <a href="{{ route('courses.lessons', $lesson->course) }}" class="btn btn-secondary">
                ← Quay lại danh sách bài học
            </a>
        </div>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="180">Khóa học</th>
                        <td><strong>{{ $lesson->course->name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Tiêu đề bài học</th>
                        <td>
                            <h5>{{ $lesson->title }}</h5>
                        </td>
                    </tr>
                    <tr>
                        <th>Thứ tự</th>
                        <td>{{ $lesson->order }}</td>
                    </tr>
                    <tr>
                        <th>Video URL</th>
                        <td>
                            @if ($lesson->video_url)
                                <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="bi bi-play-circle"></i> Xem video
                                </a>
                            @else
                                <span class="text-muted">Không có video</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Nội dung bài học</th>
                        <td>
                            <div class="border p-3 bg-light" style="min-height: 200px;">
                                {{ $lesson->content ?? 'Chưa có nội dung chi tiết.' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $lesson->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="mt-4">
                    <a href="{{ route('lessons.edit', [$lesson->course, $lesson]) }}" class="btn btn-warning btn-lg px-4">
                        Sửa bài học
                    </a>
                    <a href="{{ route('courses.lessons', $lesson->course) }}" class="btn btn-secondary btn-lg px-4">
                        Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
