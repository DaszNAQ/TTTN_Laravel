@extends('layouts.client')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">📰 Tin tức mới nhất</h2>

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('img/banner1.png') }}" class="img-fluid rounded-start" alt="TechZone mở chi nhánh">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">"Sony - Đón Hè Sang, Ngập Tràn Ưu Đãi"</h4>
                    <p class="card-text">Sony triển khai chương trình khuyến mãi "Đón Hè Sang, Ngập Tràn Ưu Đãi" với mức giảm giá lên đến 16.000.000₫
                         cho các sản phẩm máy ảnh và phụ kiện chính hãng, kèm theo nhiều tiện ích hấp dẫn như trả góp 0% qua HD SAISON,
                         thu cũ đổi mới, thuê máy ảnh và hoàn thuế (Tax Refund) cho khách quốc tế.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('img/banner2.png') }}" class="img-fluid rounded-start" alt="Top 5 sản phẩm bán chạy tháng 4">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">"Fujifilm Summer Sale – Giảm đến 55 triệu"</h4>
                    <p class="card-text">Fujifilm tung chương trình khuyến mãi mùa hè “Summer Sale” với mức ưu đãi hấp dẫn lên đến
                         55 triệu đồng dành cho các dòng máy ảnh và phụ kiện chính hãng, đi kèm các tiện ích như trả góp 0%,
                         thu cũ đổi mới, thuê máy ảnh và nhiều phần quà tặng kèm giá trị.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('img/banner3.png') }}" class="img-fluid rounded-start" alt="Top 5 sản phẩm bán chạy tháng 4">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">"Hè Rực Rỡ – Deal Hết Cỡ cùng Canon"</h4>
                    <p class="card-text">Canon triển khai chương trình “Hè Rực Rỡ – Deal Hết Cỡ” với ưu đãi giảm giá lên đến 35 triệu
                        đồng cho các sản phẩm máy ảnh chính hãng, kèm theo nhiều phần quà hấp dẫn như thẻ nhớ, khóa học nhiếp ảnh
                        cơ bản, hỗ trợ trả góp 0%, thu cũ đổi mới, thuê máy ảnh và hoàn thuế cho khách quốc tế.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
