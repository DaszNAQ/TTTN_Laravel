@extends('admin.layout')

@section('content')
<h4>Cập nhật Loại sản phẩm</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Tên loại sản phẩm</label>
        <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Nhập tên loại sản phẩm">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
