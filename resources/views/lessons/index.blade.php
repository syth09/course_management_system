@extends('layouts.app')

@section('title', 'Danh sách Bài Học')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Bài học của khóa học: <strong>{{ $course->name }}</strong></h2>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">← Quay về danh sách khóa học</a>
        </div>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <a href="{{ route('lessons.create', $course) }}" class="btn btn-success mb-3">
                    <i class="bi bi-plus-lg"></i> Thêm bài học mới
                </a>

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="80" class="text-center">Thứ tự</th>
                            <th>Tiêu đề bài học</th>
                            <th>Nội dung</th>
                            <th>Video URL</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lessons as $lesson)
                            <tr>
                                <td class="text-center fw-bold">{{ $lesson->order }}</td>
                                <td
                                    style="max-width: 360px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <strong>{{ $lesson->title }}</strong>
                                </td>
                                <td
                                    style="max-width: 360px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ Str::limit($lesson->content, 80) }}</td>
                                <td>
                                    @if ($lesson->video_url)
                                        <a href="{{ $lesson->video_url }}" target="_blank" class="text-primary small">Xem
                                            video →</a>
                                    @else
                                        <span class="text-muted small">Không có</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('lessons.show', [$course, $lesson]) }}"
                                        class="btn btn-info btn-sm text-white">Chi tiết</a>
                                    <a href="{{ route('lessons.edit', [$course, $lesson]) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('lessons.destroy', [$course, $lesson]) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Xóa bài học này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Khóa học này chưa có bài học nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
