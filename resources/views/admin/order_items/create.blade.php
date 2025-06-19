@extends('admin.layout')

@section('content')
<h4>Thêm mới Chi tiết đơn hàng</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.order_items.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Đơn hàng</label>
        <select name="order_id" class="form-control">
            <option value="">-- Chọn đơn hàng --</option>
            @foreach($orders as $order)
                <option value="{{ $order->id }}">#{{ $order->id }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Sản phẩm</label>
        <select name="product_id" class="form-control">
            <option value="">-- Chọn sản phẩm --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Số lượng</label>
        <input type="number" name="quantity" class="form-control" placeholder="Nhập số lượng" min="1">
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" class="form-control" placeholder="Nhập giá" min="0">
    </div>

    <button type="submit" class="btn btn-primary">Thêm mới</button>
    <a href="{{ route('admin.order_items.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
