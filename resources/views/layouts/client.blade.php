<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Bán Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <header class="bg-white border-bottom py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h3 class="m-0 text-primary">PropTech Zone</h3>
            </div>
            <div class="auth-links">
                <a href="{{ route('client.orders.form') }}"class="btn btn-outline-primary me-2">Tra cứu đơn hàng</a>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-primary me-2">
                    🛒 Giỏ hàng ({{ session('cart') ? count(session('cart')) : 0 }})
                </a>
            </div>
        </div>
    </header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Trang chủ</a></li>

                    <!-- Danh mục sản phẩm từ DB -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                            @foreach ($categories as $cat)
                                <li><a class="dropdown-item"
                                        href="{{ url('category/' . $cat->id) }}">{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('news') }}">Tin tức</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
                <form action="{{ route('product.search') }}" method="GET" class="d-flex ms-3" role="search">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Tìm sản phẩm..."
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>

            </div>
        </div>
    </nav>

    <!-- Nội dung chính -->
    <main class="container my-5">
        <!-- Thông báo thành công / lỗi -->
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <div class="footer mt-5 bg-light py-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>THÔNG TIN LIÊN HỆ</h5>
                    <a href="#">Mua hàng: 1900 8922</a><br>
                    <a href="#">Bảo hành: 1900 8174</a><br>
                    <a href="#">Phản ánh dịch vụ: 0909 123 456</a><br>
                    <a href="#">hotro@proptechzone.vn</a>
                </div>
                <div class="col-md-3">
                    <h5>CHÍNH SÁCH</h5>
                    <a href="#">Mua hàng & thanh toán</a><br>
                    <a href="#">Giao hàng & đổi trả</a><br>
                    <a href="#">Bảo hành</a><br>
                    <a href="#">Bảo mật thông tin</a>
                </div>
                <div class="col-md-3">
                    <h5>HỖ TRỢ</h5>
                    <a href="#">Hướng dẫn sử dụng</a><br>
                    <a href="#">Câu hỏi thường gặp</a><br>
                    <a href="#">Liên hệ chăm sóc KH</a>
                </div>
                <div class="col-md-3">
                    <h5>KẾT NỐI</h5>
                    <a href="#">Facebook</a><br>
                    <a href="#">YouTube</a><br>
                    <a href="#">Instagram</a><br>
                    <a href="#">Zalo</a>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2025 TechZone. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
