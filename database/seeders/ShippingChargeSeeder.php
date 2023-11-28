<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ShippingChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('shipping_charges')->insert([
            [
                'id' => '1','country_id' => '170','amount' => '20.00',
            ]
        ]);
    }
}
