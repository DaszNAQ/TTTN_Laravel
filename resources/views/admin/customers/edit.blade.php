@extends('admin.layout')

@section('content')
<h2>Chỉnh sửa Khách hàng</h2>

<form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tên khách hàng</label>
        <input type="text" name="name" value="{{ $customer->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $customer->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Điện thoại</label>
        <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Địa chỉ</label>
        <input type="text" name="address" value="{{ $customer->address }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
