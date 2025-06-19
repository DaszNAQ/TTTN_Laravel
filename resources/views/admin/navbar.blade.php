<!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark bg-dark navbar-custom">
    <div class="container-fluid">
        <span class="navbar-brand">Quản lý bán hàng</span>

        <div class="ms-auto d-flex align-items-center">
            @if (Auth::check())
                <span class="me-2 text-white">Hello {{ Auth::user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline me-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary text-white">Đăng xuất</button>
                </form>

                <form action="{{ route('password.change') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary text-white">Đổi mật khẩu</button>
                </form>
            @else
                <span class="me-2 text-white">Hello Guest</span>

                <form action="{{ route('login') }}" class="d-inline me-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary text-white">Đăng Nhập</button>
                </form>

                <form action="{{ route('register') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary text-white">Đăng Ký</button>
                </form>
            @endif
        </div>
    </div>
</nav>
