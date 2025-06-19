<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Điện thoại'],
            ['name' => 'Laptop'],
            ['name' => 'Tablet'],
            ['name' => 'Đồng hồ'],
            ['name' => 'Phụ kiện'],
            ['name' => 'Tai nghe'],
            ['name' => 'Tivi'],
            ['name' => 'Camera'],
            ['name' => 'Máy tính bảng'],
            ['name' => 'Đồ gia dụng'],
        ];

        DB::table('categories')->insert($categories);
    }
}
