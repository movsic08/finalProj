<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CustomerAddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_addresses')->insert([
            [
                'id' => '1','user_id' => '2','first_name' => 'Arthur','last_name' => 'Cervania','email' => 'arthurcervania13@gmail.com','mobile' => '09692696666','country_id' => '170','address' => 'Masidem Bani Pangasinan','apartment' => NULL,'city' => 'Bani','state' => 'Pangasinan','zip' => '2407',
            ],
        ]);
    }
}
