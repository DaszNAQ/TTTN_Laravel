<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('customers')->insert([
                'name' => 'Khách hàng '.$i,
                'phone' => '090'.rand(1000000, 9999999),
                'email' => 'customer'.$i.'@gmail.com',
                'address' => 'Địa chỉ '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
