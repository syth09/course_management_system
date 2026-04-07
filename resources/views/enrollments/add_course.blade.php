@extends('layouts.app')

@section('title', 'Đăng Ký Thêm Khóa Học')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Đăng ký thêm khóa học cho học viên: <strong>{{ $student->name }}</strong></h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('enrollments.add.course', $student) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn khóa học <span class="text-danger">*</span></label>
                        <select name="course_id" class="form-select" required>
                            <option value="">-- Chọn khóa học --</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->name }} ({{ number_format($course->price) }} ₫)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Đăng ký thêm</button>
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-lg px-5">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
