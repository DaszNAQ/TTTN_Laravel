@extends('layouts.client')

@section('content')
    <!-- Banner Carousel -->
    <div id="mainBanner" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/banner1.png') }}" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banner2.png') }}" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banner3.png') }}" class="d-block w-100" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Product Sections -->
    <div class="container mt-4">

        <h2 class="mb-4">Sản phẩm mới nhất</h2>
        <div class="row">
            @foreach ($latestProducts as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>
                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('product.detail', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary w-50">Xem chi tiết</a>
                                <form action="{{ route('cart.add', $product->id) }}" method="GET" class="w-50">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success w-100">Thêm giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="mb-4">Thương hiệu Canon</h2>
        <div class="row">
            @foreach ($canonProducts as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>
                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('product.detail', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary w-50">Xem chi tiết</a>
                                <form action="{{ route('cart.add', $product->id) }}" method="GET" class="w-50">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success w-100">Thêm giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="mb-4">Phụ kiện máy ảnh</h2>
        <div class="row">
            @foreach ($accessoryProducts as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} VNĐ</p>
                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('product.detail', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary w-50">Xem chi tiết</a>
                                <form action="{{ route('cart.add', $product->id) }}" method="GET" class="w-50">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success w-100">Thêm giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
