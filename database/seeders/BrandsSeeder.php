<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('brands')->insert([
            [
                'id' => '1','name' => 'Nike','slug' => 'nike','status' => '1','created_at' => '2023-09-17 03:05:39','updated_at' => '2023-09-17 03:05:39'
            ],
            [
                'id' => '2','name' => 'UnderArmour','slug' => 'underarmour','status' => '1','created_at' => '2023-09-17 03:05:50','updated_at' => '2023-09-17 03:05:50'
            ],
            [
                'id' => '3','name' => 'Jordan','slug' => 'jordan','status' => '1','created_at' => '2023-09-17 03:06:06','updated_at' => '2023-09-17 03:06:06'
            ],
            [
                'id' => '4','name' => 'Converse','slug' => 'converse','status' => '1','created_at' => '2023-09-17 03:06:15','updated_at' => '2023-09-17 03:06:15'
            ]
        ]);
    }
}
