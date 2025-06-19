@extends('admin.layout')

@section('content')
<h2>Thùng rác Khách hàng</h2>

<a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách</a>

<table class="table table-bordered">
    <thead>
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
                    <form action="{{ route('admin.customers.restore', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button onclick="return confirm('Khôi phục khách hàng này?')" class="btn btn-success btn-sm">Khôi phục</button>
                    </form>
                    <form action="{{ route('admin.customers.forceDelete', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Xoá vĩnh viễn khách hàng này?')" class="btn btn-danger btn-sm">Xoá vĩnh viễn</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{ $customers->links('pagination::bootstrap-5') }}
</div>
@endsection
