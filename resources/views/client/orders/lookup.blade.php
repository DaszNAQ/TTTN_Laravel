@extends('layouts.client')

@section('content')
    <div class="container mt-5">
        <h4>Tra cứu trạng thái đơn hàng</h4>

        <form action="{{ route('client.orders.search') }}" method="GET" class="mb-4">
            <div class="mb-3">
                <label>Email hoặc Số điện thoại:</label>
                <input type="text" name="query" class="form-control" value="{{ old('query', $input ?? '') }}" required>
            </div>
            <button class="btn btn-primary">Tra cứu</button>
        </form>

        @isset($orders)
            @if ($orders->count() > 0)
                <h5>Kết quả tìm được:</h5>
                @foreach ($orders as $order)
                    <div class="border p-3 mb-4 rounded bg-light">
                        <h5>Đơn hàng #{{ $order->id }}</h5>
                        <p><strong>Khách hàng:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Email:</strong> {{ $order->customer->email }}</p>
                        <p><strong>Điện thoại:</strong> {{ $order->customer->phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->customer->address }}</p>
                        <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                        <p><strong>Trạng thái:</strong>
                            @switch($order->status)
                                @case('pending')
                                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                @break

                                @case('processing')
                                    <span class="badge bg-primary">Đang giao</span>
                                @break

                                @case('completed')
                                    <span class="badge bg-success">Hoàn tất</span>
                                @break

                                @case('cancelled')
                                    <span class="badge bg-danger">Đã huỷ</span>
                                @break

                                @default
                                    <span class="badge bg-secondary">Không rõ</span>
                            @endswitch
                        </p>
                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

                        <h6 class="mt-3">Sản phẩm trong đơn:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? '[SP đã xoá]' }}</td>
                                        <td>{{ number_format($item->price) }} đ</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price * $item->quantity) }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Tổng cộng:</th>
                                    <th>
                                        {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity)) }} đ
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endforeach
            @else
                <h2>Không tìm thấy đơn hàng nào với thông tin vừa nhập.</h2>
            @endif
        @endisset
    </div>
@endsection
