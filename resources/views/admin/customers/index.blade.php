@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Danh sách Khách hàng</h4>
    <div>
        <a href="{{ route('admin.customers.trash') }}" class="btn btn-danger">🗑️ Thùng rác</a>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">➕ Thêm mới</a>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->address }}</td>
                <td>
                    <a href="{{ route('admin.customers.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.customers.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Bạn có chắc chắn muốn xoá?')" class="btn btn-danger btn-sm">Xoá</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $customers->links('pagination::bootstrap-5') }}
</div>
@endsection
