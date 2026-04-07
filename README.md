# Course Management System - Quản Lý Khóa Học

## I. Giới thiệu

Hệ thống quản lý khóa học trực tuyến được xây dựng bằng Laravel 12, Bootstrap 5.

## II. Chức năng chính

- Quản lý Khóa học (CRUD + Soft Delete + Upload ảnh + Slug)
- Quản lý Bài học (theo từng khóa học)
- Quản lý Đăng ký học viên
- Dashboard thống kê
- Tìm kiếm, lọc, phân trang
- Validation với FormRequest

## III. Hướng dẫn cài đặt

### 1. Clone dự án hoặc giải nén file

### 2. Chạy lệnh

    ```bash
    composer install
    cp .env.example .env
    php artisan key:generate
    ```

### 3. Cấu hình database trong file .env

### 4. Chạy migration

    ```bash
    php artisan migrate
    ```

### 5. Tạo symlink cho storage (upload ảnh)

    ```bash
    php artisan storage:link
    ```

### 6. Chạy server

    ```bash
    php artisan serve
    ```

- Truy cập server: `[http://127.0.0.1:8000]`
