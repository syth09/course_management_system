@extends('layouts.app')

@section('title', 'Chi tiết Khóa Học')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Chi tiết Khóa Học: {{ $course->name }}</h2>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
        </div>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                @if ($course->image)
                    <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid rounded shadow"
                        alt="{{ $course->name }}">
                @else
                    <div class="bg-light border rounded text-center py-5">
                        <h5 class="text-muted">Chưa có ảnh</h5>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th width="180">Tên khóa học</th>
                        <td><strong>{{ $course->name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $course->slug }}</td>
                    </tr>
                    <tr>
                        <th>Giá</th>
                        <td class="text-success fw-bold">{{ number_format($course->price) }} ₫</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            <span class="badge {{ $course->status == 'published' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Số bài học</th>
                        <td>{{ $course->lesson_count }}</td>
                    </tr>
                    <tr>
                        <th>Số học viên</th>
                        <td>{{ $course->student_count }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $course->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <h5 class="mt-4">Mô tả khóa học</h5>
                <p class="border p-3 bg-light">{{ $course->description ?? 'Chưa có mô tả.' }}</p>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Danh sách bài học</h5>
            <a href="{{ route('lessons.create', $course) }}" class="btn btn-success btn-sm">+ Thêm bài học</a>
        </div>

        @if ($course->lessons->isEmpty())
            <p class="text-muted">Khóa học này chưa có bài học nào.</p>
        @else
            <div class="list-group">
                @foreach ($course->lessons as $lesson)
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>{{ $lesson->order }}. {{ $lesson->title }}</strong>
                            </div>
                            <div>
                                <a href="{{ route('lessons.edit', [$course, $lesson]) }}"
                                    class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('lessons.destroy', [$course, $lesson]) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Xóa bài học này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </div>
                        </div>
                        @if ($lesson->video_url)
                            <small class="text-primary">Video: <a href="{{ $lesson->video_url }}"
                                    target="_blank">{{ $lesson->video_url }}</a></small>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
