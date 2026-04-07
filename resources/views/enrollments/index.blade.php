@extends('layouts.app')

@section('title', 'Danh sách Đăng Ký')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Đăng Ký Khóa Học</h2>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary">+ Đăng ký mới</a>
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
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Học viên</th>
                            <th>Email</th>
                            <th>Khóa học</th>
                            <th>Ngày đăng ký</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $enrollment)
                            <tr>
                                <td><strong>{{ $enrollment->student->name }}</strong></td>
                                <td>{{ $enrollment->student->email }}</td>
                                <td>{{ $enrollment->course->name }}</td>
                                <td>{{ $enrollment->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('enrollments.show', $enrollment) }}"
                                        class="btn btn-info btn-sm text-white">Chi tiết</a>

                                    <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Bạn chắc chắn muốn hủy đăng ký khóa học này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Chưa có đăng ký nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $enrollments->links() }}
    </div>
@endsection
