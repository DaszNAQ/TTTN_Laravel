@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Danh sách Chi tiết đơn hàng đã xoá (Thùng rác)</h4>
    <a href="{{ route('admin.order_items.index') }}" class="btn btn-secondary">← Quay về Danh sách</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Đơn hàng</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>#{{ $item->order->id ?? '' }}</td>
            <td>{{ $item->product->name ?? '' }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price) }} ₫</td>
            <td>
                <form action="{{ route('admin.order_items.restore', $item->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    <button class="btn btn-sm btn-success">Khôi phục</button>
                </form>

                <form action="{{ route('admin.order_items.forceDelete', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xoá vĩnh viễn?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xoá vĩnh viễn</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $orderItems->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>
@endsection
