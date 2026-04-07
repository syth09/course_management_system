@extends('layouts.app')

@section('title', 'Dashboard - Quản Lý Khóa Học')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Dashboard - Quản Lý Khóa Học</h2>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Tổng khóa học</h5>
                        <h3>{{ $totalCourses }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Tổng học viên</h5>
                        <h3>{{ $totalStudents }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Tổng đăng ký</h5>
                        <h3>{{ $totalEnrollments }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Tổng doanh thu</h5>
                        <h3>{{ number_format($totalRevenue) }} ₫</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8">
                <h5>5 Khóa học mới nhất</h5>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tên khóa học</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestCourses as $course)
                                    <tr>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ number_format($course->price) }} ₫</td>
                                        <td>
                                            <span
                                                class="badge {{ $course->status == 'published' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($course->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h5>Khóa học nhiều học viên nhất</h5>
                @if ($topCourse)
                    <div class="card border-primary">
                        <div class="card-body text-center">
                            <h5>{{ $topCourse->name }}</h5>
                            <p class="text-muted">{{ $topCourse->student_count }} học viên</p>
                            <a href="{{ route('courses.show', $topCourse) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
