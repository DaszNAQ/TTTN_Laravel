<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('orders')->insert([
                'customer_id' => $i,
                'note' => 'Ghi chú đơn hàng '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
