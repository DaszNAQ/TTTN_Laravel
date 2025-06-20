@extends('layouts.client')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h3>🔐 Đăng nhập khách hàng</h3>
    <form method="POST" action="{{ route('customer.login.post') }}">
        @csrf
        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary mt-2">Đăng nhập</button>
    </form>
</div>
@endsection
