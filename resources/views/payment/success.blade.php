@extends('layouts.client')


@section('content')
    <div class="container text-center mt-5">
        <h2 class="text-success">✅ Thanh toán thành công!</h2>
        <p>Đơn hàng <strong>#{{ $orderId }}</strong> của bạn đã được thanh toán qua MoMo.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Về trang chủ</a>
    </div>
@endsection
