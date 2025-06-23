@extends('layouts.client')

@section('content')
    <div class="container text-center mt-5">
        <h2 class="text-danger">❌ Thanh toán thất bại!</h2>
        <p>Đơn hàng <strong>#{{ $orderId }}</strong> chưa được thanh toán thành công.</p>
        <a href="{{ route('cart.index') }}" class="btn btn-warning mt-3">Quay lại giỏ hàng</a>
    </div>
@endsection
