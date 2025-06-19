<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple'],
            ['name' => 'Samsung'],
            ['name' => 'Sony'],
            ['name' => 'Dell'],
            ['name' => 'HP'],
            ['name' => 'Oppo'],
            ['name' => 'Xiaomi'],
            ['name' => 'Asus'],
            ['name' => 'Acer'],
            ['name' => 'Lenovo'],
        ];

        DB::table('brands')->insert($brands);
    }
}
