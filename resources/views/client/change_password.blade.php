@extends('layouts.client')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h3>🔐 Đổi mật khẩu</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('customer.password.update') }}">
        @csrf
        <div class="form-group mb-2">
            <label>Mật khẩu hiện tại</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Nhập lại mật khẩu mới</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary mt-2">Cập nhật mật khẩu</button>
    </form>
</div>
@endsection
