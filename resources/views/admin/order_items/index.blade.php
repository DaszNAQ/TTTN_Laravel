@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Danh sách Chi tiết đơn hàng</h4>
    <div>
        <a href="{{ route('admin.order_items.trash') }}" class="btn btn-danger">🗑️ Thùng rác</a>
        <a href="{{ route('admin.order_items.create') }}" class="btn btn-primary">➕ Thêm mới</a>
    </div>
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
                <a href="{{ route('admin.order_items.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.order_items.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xoá?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xoá</button>
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
