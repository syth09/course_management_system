@extends('layouts.app')

@section('title', 'Chi tiết Đăng Ký')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Chi tiết Đăng Ký</h2>
            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
        </div>

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
                        <th width="200">Học viên</th>
                        <td><strong>{{ $enrollment->student->name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $enrollment->student->email }}</td>
                    </tr>
                    <tr>
                        <th>Khóa học</th>
                        <td><strong>{{ $enrollment->course->name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Giá khóa học</th>
                        <td class="text-success fw-bold">{{ number_format($enrollment->course->price ?? 0) }} ₫</td>
                    </tr>
                    <tr>
                        <th>Ngày đăng ký</th>
                        <td>{{ $enrollment->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <div class="mt-4">
                    <a href="{{ route('courses.show', $enrollment->course) }}" class="btn btn-info">
                        Xem chi tiết khóa học
                    </a>
                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
@endsection
