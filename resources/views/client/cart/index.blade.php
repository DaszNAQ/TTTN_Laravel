@extends('layouts.client')

@section('content')

    <div class="container mt-5">
        <h2 class="mb-4">Giỏ hàng của bạn</h2>
        @if (!session('customer'))
            <div class="alert alert-warning text-center">
                ⚠️ Bạn cần <a href="{{ route('customer.login') }}">đăng nhập</a> để có thể tiến hành đặt hàng.
            </div>
        @endif

        @if (session('cart') && count(session('cart')) > 0)
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr class="table-primary">
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach (session('cart') as $id => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" data-id="{{ $id }}"
                                        value="{{ $item['quantity'] }}" min="1" style="width: 80px;">
                                </td>
                                <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')">
                                            Xoá
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-success">
                            <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td colspan="2"><strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('home') }}" class="btn btn-secondary">Tiếp tục mua hàng</a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-success">Đặt hàng</a>
            </div>
        @else
            <div class="alert alert-warning">
                Giỏ hàng của bạn đang trống.
            </div>
        @endif
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.quantity-input');

            inputs.forEach(input => {
                input.addEventListener('change', async function() {
                    const id = this.dataset.id;
                    const quantity = this.value;

                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('quantities[' + id + ']', quantity);

                    try {
                        await fetch('{{ route('cart.update') }}', {
                            method: 'POST',
                            body: formData
                        });
                        window.location.reload();
                    } catch (error) {
                        alert('Cập nhật thất bại!');
                    }
                });
            });
        });
    </script>
@endsection
