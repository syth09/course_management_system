@extends('layouts.app')

@section('title', 'Sửa Khóa Học')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Sửa Khóa Học: {{ $course->name }}</h2>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên khóa học <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $course->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Giá (VNĐ) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control"
                                    value="{{ old('price', $course->price) }}" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả khóa học</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ảnh hiện tại</label><br>
                                @if ($course->image)
                                    <img src="{{ asset('storage/' . $course->image) }}" class="img-thumbnail mb-2"
                                        style="max-height: 180px;">
                                @endif
                                <label class="form-label">Chọn ảnh mới (nếu muốn thay đổi)</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="draft"
                                        {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft (Nháp)
                                    </option>
                                    <option value="published"
                                        {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Published
                                        (Công khai)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning btn-lg px-5">Cập nhật khóa học</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-lg px-5">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
