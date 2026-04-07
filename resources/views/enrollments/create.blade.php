@extends('layouts.app')

@section('title', 'Đăng Ký Khóa Học')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Đăng Ký Khóa Học</h2>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn khóa học <span class="text-danger">*</span></label>
                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                            <option value="">-- Chọn khóa học --</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }} ({{ number_format($course->price) }} ₫)
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên học viên <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Đăng ký khóa học</button>
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-lg px-5">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
