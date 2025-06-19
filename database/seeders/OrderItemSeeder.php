<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('order_items')->insert([
                'order_id' => rand(1, 10),
                'product_id' => rand(1, 20),
                'quantity' => rand(1, 5),
                'price' => rand(500, 10000) * 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
