@extends('layouts.app')

@section('title', 'Danh sách Khóa Học')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Khóa Học</h2>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">+ Thêm khóa học mới</a>
        </div>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 80px;">Ảnh</th>
                            <th>Tên khóa học</th>
                            <th class="text-end">Giá</th>
                            <th class="text-center">Số bài học</th>
                            <th class="text-center">Số học viên</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center" style="width: 220px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td class="text-center">
                                    @if ($course->image)
                                        <img src="{{ asset('storage/' . $course->image) }}" width="60" height="40"
                                            style="object-fit: cover; border-radius: 4px;" alt="{{ $course->name }}">
                                    @else
                                        <span class="text-muted small">No image</span>
                                    @endif
                                </td>
                                <td><strong>{{ $course->name }}</strong></td>
                                <td class="text-end fw-bold">{{ number_format($course->price) }} ₫</td>
                                <td class="text-center">{{ $course->lesson_count }}</td>
                                <td class="text-center">{{ $course->student_count }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $course->status == 'published' ? 'bg-success' : 'bg-warning' }} px-3 py-2">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('courses.show', $course) }}"
                                            class="btn btn-info btn-sm text-white">Chi tiết</a>
                                        <a href="{{ route('courses.edit', $course) }}"
                                            class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="{{ route('courses.destroy', $course) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Bạn chắc chắn muốn xóa khóa học này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    Chưa có khóa học nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
