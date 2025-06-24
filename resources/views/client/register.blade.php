@extends('layouts.client')

@section('content')
    <div class="container mt-5" style="max-width: 500px;">
        <h3>Đăng ký tài khoản</h3>
        <form method="POST" action="{{ route('customer.register.post') }}">
            @csrf
            <div class="form-group mb-2">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label>SĐT</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-success mt-2">Đăng ký</button>
        </form>
    </div>
@endsection
