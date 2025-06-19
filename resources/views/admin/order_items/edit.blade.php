@extends('admin.layout')

@section('content')
<h4>Chỉnh sửa Chi tiết đơn hàng</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.order_items.update', $orderItem->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Đơn hàng</label>
        <select name="order_id" class="form-control">
            @foreach($orders as $order)
                <option value="{{ $order->id }}" {{ $order->id == $orderItem->order_id ? 'selected' : '' }}>#{{ $order->id }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Sản phẩm</label>
        <select name="product_id" class="form-control">
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $product->id == $orderItem->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Số lượng</label>
        <input type="number" name="quantity" value="{{ $orderItem->quantity }}" class="form-control" min="1">
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" value="{{ $orderItem->price }}" class="form-control" min="0">
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.order_items.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
