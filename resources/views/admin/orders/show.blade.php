@extends('admin.layout')

@section('content')
    <h4>Chi tiết đơn hàng #{{ $order->id }}</h4>

    <p><strong>Khách hàng:</strong> {{ $order->customer->name }}</p>
    <p><strong>Email:</strong> {{ $order->customer->email }}</p>
    <p><strong>Điện thoại:</strong> {{ $order->customer->phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->customer->address }}</p>
    <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
    <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <h5 class="mt-4">Danh sách sản phẩm</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? '[SP đã xoá]' }}</td>
                    <td>{{ number_format($item->price) }} đ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
@endsection
