@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Tổng sản phẩm</h5>
                        <h3>{{ $totalProducts }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Tổng đơn hàng</h5>
                        <h3>{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Tổng doanh thu (hoàn tất)</h5>
                        <h3>{{ number_format($totalRevenue) }} đ</h3>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
