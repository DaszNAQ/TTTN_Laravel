@extends('admin.layout')

@section('content')
<h4>Chỉnh sửa Đơn hàng</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Khách hàng</label>
        <select name="customer_id" class="form-control">
            @foreach($customers as $cus)
                <option value="{{ $cus->id }}" {{ $cus->id == $order->customer_id ? 'selected' : '' }}>{{ $cus->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Ghi chú</label>
        <textarea name="note" rows="4" class="form-control">{{ $order->note }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
