@extends('layouts.client')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Danh mục: {{ $category->name }}</h3>

    @if($products->count() > 0)
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>

                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ url('/product/' . $product->id) }}" class="btn btn-outline-primary btn-sm w-50">
                            Xem chi tiết
                        </a>
                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success btn-sm w-50">
                            Thêm vào giỏ
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <p>Hiện không có sản phẩm nào trong danh mục này.</p>
    @endif
</div>
@endsection
