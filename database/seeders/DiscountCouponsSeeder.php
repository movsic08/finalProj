<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DiscountCouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('discount_coupons')->insert([
            [
                'id' => '1','code' => 'DIS30PER','name' => '30% discount','description' => '<p>This is a 30% discount</p>','max_uses' => '3','max_uses_user' => '2','type' => 'percent','discount_amount' => '30.00','min_amount' => '2000.00','status' => '1','starts_at' => '2023-08-17 21:01:35','expires_at' => '2023-10-26 21:01:40',
            ],
            [
                'id' => '2','code' => '200DIS','name' => '200 pesos full discount','description' => '<p>This is a full 200 pesos discount on orders above 20000</p>','max_uses' => '1','max_uses_user' => '1','type' => 'fixed','discount_amount' => '200.00','min_amount' => '20000.00','status' => '1','starts_at' => '2023-08-18 21:23:19','expires_at' => '2023-09-29 21:23:23',
            ]
        ]);

    }
}
