@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Danh sách Người dùng</h4>
    <div>
        <a href="{{ route('admin.users.trash') }}" class="btn btn-danger">🗑️ Thùng rác</a>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Thêm mới</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ ucfirst($item->role) }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xoá?')">
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
    {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>
@endsection
