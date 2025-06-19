@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded border">
        </div>
        <div class="col-md-7">
            <h2>{{ $product->name }}</h2>
            <p class="text-danger fw-bold fs-4">{{ number_format($product->price) }} VNĐ</p>
            <p><strong>Danh mục:</strong> {{ $product->category->name ?? 'Chưa phân loại' }}</p>
            <p><strong>Mô tả:</strong></p>
            <p>{{ $product->description }}</p>

            <form action="{{ route('cart.add', $product->id) }}" method="GET">
                <button type="submit" class="btn btn-primary mt-3">
                    Thêm vào giỏ hàng 🛒
                </button>
            </form>

        </div>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@endsection
