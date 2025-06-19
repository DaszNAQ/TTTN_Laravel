@extends('admin.layout')

@section('content')
<h4>Thêm mới Thương hiệu</h4>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            <div>{{ $err }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.brands.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tên thương hiệu</label>
        <input type="text" name="name" class="form-control" placeholder="Nhập tên thương hiệu">
    </div>
    <button type="submit" class="btn btn-primary">Thêm mới</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
