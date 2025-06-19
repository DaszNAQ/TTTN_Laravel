@extends('admin.layout')

@section('content')
<h4>Thêm mới Sản phẩm</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" class="form-control" placeholder="Nhập giá sản phẩm">
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <select name="category_id" class="form-control">
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Thương hiệu</label>
        <select name="brand_id" class="form-control">
            <option value="">-- Chọn thương hiệu --</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Hình ảnh</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" rows="4" class="form-control" placeholder="Mô tả sản phẩm"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Thêm mới</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
