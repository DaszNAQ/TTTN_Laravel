@extends('admin.layout')

@section('content')
<h2>Thêm Khách hàng</h2>

<form action="{{ route('admin.customers.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Tên khách hàng</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Điện thoại</label>
        <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
