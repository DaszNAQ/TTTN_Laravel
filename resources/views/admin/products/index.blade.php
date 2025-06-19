@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Danh sách Sản phẩm</h4>
        <div>
            <a href="{{ route('admin.products.trash') }}" class="btn btn-danger">🗑️ Thùng rác</a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">➕ Thêm mới</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price) }} ₫</td>
                    <td>{{ $item->category->name ?? '' }}</td>
                    <td>{{ $item->brand->name ?? '' }}</td>
                    <td>
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" width="80" />
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $item) }}" class="btn btn-sm btn-warning">Xem & Sửa</a>
                        <form action="{{ route('admin.products.destroy', $item) }}" method="POST" class="d-inline-block"
                            onsubmit="return confirm('Bạn có chắc muốn xoá?')">
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
        {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
@endsection
