@extends('admin.layout')

@section('content')
<h4>Thêm người dùng mới</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" class="form-control" placeholder="Nhập tên người dùng">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Nhập email">
    </div>

    <div class="mb-3">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
    </div>

    <div class="mb-3">
        <label>Vai trò</label>
        <select name="role" class="form-control">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Thêm mới</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
