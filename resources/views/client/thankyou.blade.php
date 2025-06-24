@extends('layouts.client')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Cảm ơn bạn đã đặt hàng!</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
        $order = \App\Models\Order::with('items.product')->find(session('last_order_id'));
    @endphp

    @if($order)
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p><strong>Trạng thái thanh toán:</strong>
                    @if($order->payment_status == 'paid')
                        <span class="text-success">Đã thanh toán</span>
                    @else
                        <span class="text-warning">Chờ thanh toán</span>
                    @endif
                </p>
            </div>
        </div>

        <h4>Chi tiết đơn hàng:</h4>
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($order->items as $item)
                    @php
                        $subtotal = $item->price * $item->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->product->name ?? 'Đã xoá' }}</td>
                        <td>{{ number_format($item->price) }}₫</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($subtotal) }}₫</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td><strong>{{ number_format($total) }}₫</strong></td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="alert alert-danger">Không tìm thấy đơn hàng.</div>
    @endif

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">🔙 Quay về trang chủ</a>
</div>
@endsection
