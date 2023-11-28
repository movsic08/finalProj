<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('orders')->insert([
            [
                'id' => '1','user_id' => '2','subtotal' => '11647.00','shipping' => '40.00','coupon_code' => 'dis30percent','coupon_code_id' => '5','discount' => '3494.10','grandtotal' => '8192.90','first_name' => 'Arthur','last_name' => 'Cervania','email' => 'arthurcervania13@gmail.com','mobile' => '09692696666','country_id' => '170','address' => 'Masidem Bani Pangasinan','apartment' => NULL,'city' => 'Bani','state' => 'Pangasinan','zip' => '2407','notes' => NULL,'created_at' => '2023-09-18 08:54:31','updated_at' => '2023-09-18 08:54:31'
            ],
            [
                'id' => '2','user_id' => '2','subtotal' => '13635.00','shipping' => '40.00','coupon_code' => 'DIS30PER','coupon_code_id' => '1','discount' => '4090.50','grandtotal' => '9584.50','first_name' => 'Arthur','last_name' => 'Cervania','email' => 'arthurcervania13@gmail.com','mobile' => '09692696666','country_id' => '170','address' => 'Masidem Bani Pangasinan','apartment' => NULL,'city' => 'Bani','state' => 'Pangasinan','zip' => '2407','notes' => NULL,'created_at' => '2023-09-18 13:14:28','updated_at' => '2023-09-18 13:14:28'
            ],
            [
                'id' => '3','user_id' => '2','subtotal' => '14579.00','shipping' => '40.00','coupon_code' => 'DIS30PER','coupon_code_id' => '1','discount' => '4373.70','grandtotal' => '10245.30','first_name' => 'Arthur','last_name' => 'Cervania','email' => 'arthurcervania13@gmail.com','mobile' => '09692696666','country_id' => '170','address' => 'Masidem Bani Pangasinan','apartment' => NULL,'city' => 'Bani','state' => 'Pangasinan','zip' => '2407','notes' => NULL,'created_at' => '2023-09-18 13:15:17','updated_at' => '2023-09-18 13:15:17'
            ],
            [
                'id' => '4','user_id' => '2','subtotal' => '20463.00','shipping' => '60.00','coupon_code' => '200DIS','coupon_code_id' => '2','discount' => '200.00','grandtotal' => '20323.00','first_name' => 'Arthur','last_name' => 'Cervania','email' => 'arthurcervania13@gmail.com','mobile' => '09692696666','country_id' => '170','address' => 'Masidem Bani Pangasinan','apartment' => NULL,'city' => 'Bani','state' => 'Pangasinan','zip' => '2407','notes' => NULL,'created_at' => '2023-09-18 13:31:41','updated_at' => '2023-09-18 13:31:41'
            ]
        ]);
    }
}
