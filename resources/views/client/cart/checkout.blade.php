@extends('layouts.client')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Xác nhận đặt hàng</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif



        <form action="{{ route('cart.processCheckout') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Họ và tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Địa chỉ</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('cart.index') }}" class="btn btn-secondary">Quay lại giỏ hàng</a>
                <button type="submit" class="btn btn-success">Xác nhận đặt hàng</button>
            </div>
        </form>
    </div>
@endsection
