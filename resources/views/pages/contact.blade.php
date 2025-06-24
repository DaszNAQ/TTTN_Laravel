@extends('layouts.client')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-primary">
            <i class="bi bi-telephone-fill me-2"></i>Liên hệ với chúng tôi
        </h2>

        <div class="row bg-white shadow-sm p-4 rounded">
            <div class="col-md-6 border-end">
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nguyễn Văn A"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email liên hệ</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">Nội dung</label>
                        <textarea class="form-control" id="message" name="message" rows="5"
                            placeholder="Bạn muốn gửi điều gì đến chúng tôi?" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-send-fill me-1"></i>Gửi liên hệ
                    </button>
                </form>
            </div>

            <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                <h3 class="fw-bold mb-3">Thông tin liên hệ</h3>
                <h5><i class="bi bi-geo-alt-fill text-danger me-2"></i><strong>Địa chỉ:</strong> 20 Tăng Nhơn Phú, Phước
                    Long B, Thủ Đức</h5>
                <h5><i class="bi bi-telephone-fill text-success me-2"></i><strong>Điện thoại:</strong> 0909 123 456</h5>
                <h5><i class="bi bi-envelope-fill text-primary me-2"></i><strong>Email:</strong> support@techzone.vn</h5>

                <div class="mt-4">
                    <h4 class="fw-semibold">Thời gian làm việc:</h4>
                    <ul class="list-unstyled ms-3">
                        <li>
                            <h5> Thứ 2 - Thứ 7: 8:00 - 17:30 </h5>
                        </li>
                        <li>
                            <h5> Chủ nhật: Nghỉ </h5>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
