<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar border-end" style="min-height: 100vh;">
                <div class="position-sticky pt-3 px-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="bi bi-house-door me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('courses.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('courses.index') }}">
                                <i class="bi bi-book me-2"></i> Khóa Học
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('lessons.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('courses.index') }}">
                                <i class="bi bi-journal-text me-2"></i> Bài Học
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('enrollments.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('enrollments.index') }}">
                                <i class="bi bi-person-check me-2"></i> Đăng Ký
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Nội dung chính -->
            <main class="col-md-9 col-lg-10 ms-sm-auto px-4">
                <div class="mt-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
