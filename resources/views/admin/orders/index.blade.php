@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Danh sách Đơn hàng</h4>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Ghi chú</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->customer->name ?? '' }}</td>
                    <td>{{ $item->note }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>
                        @switch($item->status)
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
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $item->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                        <a href="{{ route('admin.orders.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
@endsection
