@extends('layouts.app')

@section('title', 'Thêm Khóa Học Mới')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Thêm Khóa Học Mới</h2>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên khóa học <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Giá (VNĐ) <span class="text-danger">*</span></label>
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                                    min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả khóa học</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ảnh khóa học</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Nháp)
                                    </option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                                        (Công khai)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Thêm khóa học</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-lg px-5">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
