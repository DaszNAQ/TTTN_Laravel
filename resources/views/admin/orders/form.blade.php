@extends('admin.layout')

@section('content')
    <h4>{{ $readonly ? 'Chi tiết Đơn hàng #' . $order->id : 'Chỉnh sửa Đơn hàng #' . $order->id }}</h4>

    <p><strong>Khách hàng:</strong> {{ $order->customer->name }}</p>
    <p><strong>Email:</strong> {{ $order->customer->email }}</p>
    <p><strong>Điện thoại:</strong> {{ $order->customer->phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->customer->address }}</p>
    <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
    <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <h5 class="mt-4">Danh sách sản phẩm</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? '[SP đã xoá]' }}</td>
                    <td>{{ number_format($item->price) }} đ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (!$readonly)
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label><strong>Khách hàng</strong></label>
            <select name="customer_id" class="form-control">
                @foreach ($customers as $cus)
                    <option value="{{ $cus->id }}" {{ $order->customer_id == $cus->id ? 'selected' : '' }}>
                        {{ $cus->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label><strong>Ghi chú</strong></label>
            <textarea name="note" class="form-control">{{ $order->note }}</textarea>
        </div>

        <div class="mb-3">
            <label><strong>Trạng thái đơn hàng</strong></label>
            <select name="status" class="form-control">
                @foreach(['pending' => 'Chờ xử lý', 'processing' => 'Đang giao', 'completed' => 'Hoàn tất', 'cancelled' => 'Đã huỷ'] as $value => $label)
                    <option value="{{ $value }}" {{ $order->status == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật đơn hàng</button>
    </form>
    @endif

    @if ($editStatusOnly)
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label><strong>Trạng thái đơn hàng</strong></label>
            <select name="status" class="form-control">
                @foreach(['pending' => 'Chờ xử lý', 'processing' => 'Đang giao', 'completed' => 'Hoàn tất', 'cancelled' => 'Đã huỷ'] as $value => $label)
                    <option value="{{ $value }}" {{ $order->status == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật trạng thái</button>
    </form>
    @endif

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">⬅ Quay lại</a>
@endsection
