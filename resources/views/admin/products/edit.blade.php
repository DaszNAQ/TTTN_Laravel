@extends('admin.layout')

@section('content')
<h4>Chỉnh sửa Sản phẩm</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" value="{{ $product->price }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Thương hiệu</label>
        <select name="brand_id" class="form-control">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Hình ảnh hiện tại</label><br>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" width="100">
        @endif
    </div>

    <div class="mb-3">
        <label>Cập nhật Hình ảnh</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
