@extends('admin.layout')

@section('content')
<h4>Thêm mới Đơn hàng</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.orders.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Khách hàng</label>
        <select name="customer_id" class="form-control">
            <option value="">-- Chọn khách hàng --</option>
            @foreach($customers as $cus)
                <option value="{{ $cus->id }}">{{ $cus->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Ghi chú</label>
        <textarea name="note" rows="4" class="form-control" placeholder="Ghi chú đơn hàng"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Thêm mới</button>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
