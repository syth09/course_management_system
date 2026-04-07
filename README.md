# Course Management System - Quản Lý Khóa Học

## I. Giới thiệu

Hệ thống **Quản Lý Khóa Học Trực Tuyến** được xây dựng bằng **Laravel 12** và **Bootstrap 5**.  
Hệ thống hỗ trợ quản trị viên quản lý khóa học, bài học và đăng ký của học viên một cách đầy đủ và dễ dàng.

## II. Chức năng chính

- **Quản lý Khóa học**: Thêm, sửa, xóa (Soft Delete), khôi phục, upload ảnh, tự động tạo slug.
- **Quản lý Bài học**: Thêm, sửa, xóa bài học theo từng khóa học, sắp xếp thứ tự.
- **Quản lý Đăng ký**: Học viên có thể đăng ký nhiều khóa học, hủy đăng ký.
- **Dashboard**: Thống kê tổng số khóa học, học viên, đăng ký và doanh thu.
- Tìm kiếm, lọc theo trạng thái, sắp xếp theo giá/số học viên.
- Phân trang và thông báo thành công.

## III. Công nghệ sử dụng

- Laravel 12
- Bootstrap 5 + Bootstrap Icons
- SQLite (Database mặc định)
- Eloquent ORM + Soft Deletes
- Form Request Validation
- Storage cho upload ảnh

## IV. Hướng dẫn cài đặt & chạy

### 1. Cài đặt dependencies

```bash
composer install
```

### 2. Copy file môi trường

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Chạy Migration

```bash
php artisan migrate:fresh
```

### 4. Tạo liên kết storage (để hiển thị ảnh)

```bash
php artisan storage:link
```

### 5. Chạy server

```bash
php artisan serve
```

- Truy cập hệ thống tại: `http://127.0.0.1:8000`

## V. Lưu ý quan trọng

- Dự án sử dụng SQLite làm cơ sở dữ liệu (file database/database.sqlite).
- Không cần cấu hình thông tin database trong file .env.
- Sau khi chạy storage:link, ảnh khóa học sẽ được lưu trong thư mục storage/app/public/courses.
- Soft Delete được áp dụng cho bảng courses.

## VI. Các route chính

/ → Dashboard
/courses → Quản lý khóa học
/courses/{course}/lessons → Bài học của khóa học
/enrollments → Quản lý đăng ký
