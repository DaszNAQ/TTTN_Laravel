<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone 14 Pro Max',
                'category_id' => 1,
                'brand_id' => 1,
                'price' => 33990000,
                'description' => 'Điện thoại cao cấp của Apple',
                'image' => 'iphone14promax.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'category_id' => 1,
                'brand_id' => 2,
                'price' => 29990000,
                'description' => 'Điện thoại flagship mới nhất của Samsung',
                'image' => 'galaxys24ultra.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell XPS 13 9315',
                'category_id' => 2,
                'brand_id' => 4,
                'price' => 38990000,
                'description' => 'Laptop mỏng nhẹ, hiệu năng mạnh mẽ',
                'image' => 'dellxps13.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MacBook Pro M2 2023',
                'category_id' => 2,
                'brand_id' => 1,
                'price' => 46990000,
                'description' => 'Laptop Apple chip M2 cực mạnh',
                'image' => 'macbookprom2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iPad Air 5',
                'category_id' => 3,
                'brand_id' => 1,
                'price' => 16990000,
                'description' => 'Máy tính bảng mạnh mẽ cho học tập và làm việc',
                'image' => 'ipadair5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy Tab S9',
                'category_id' => 3,
                'brand_id' => 2,
                'price' => 20990000,
                'description' => 'Máy tính bảng Android cao cấp',
                'image' => 'tabs9.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Apple Watch Series 9',
                'category_id' => 4,
                'brand_id' => 1,
                'price' => 11990000,
                'description' => 'Đồng hồ thông minh cao cấp Apple',
                'image' => 'applewatch9.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy Watch 6',
                'category_id' => 4,
                'brand_id' => 2,
                'price' => 7990000,
                'description' => 'Đồng hồ thông minh mới nhất của Samsung',
                'image' => 'galaxywatch6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tai nghe AirPods Pro 2',
                'category_id' => 5,
                'brand_id' => 1,
                'price' => 5990000,
                'description' => 'Tai nghe không dây chống ồn Apple',
                'image' => 'airpodspro2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tai nghe Samsung Buds2 Pro',
                'category_id' => 5,
                'brand_id' => 2,
                'price' => 4990000,
                'description' => 'Tai nghe Bluetooth cao cấp Samsung',
                'image' => 'buds2pro.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Bạn có thể thêm thêm 10 sản phẩm khác nếu muốn có 20 sản phẩm!
        ]);
    }
}
