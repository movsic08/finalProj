<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('sub_categories')->insert([
            [
                'id' => '1','name' => 'Men','slug' => 'men','status' => '1','showHome' => 'Yes','category_id' => '1','created_at' => '2023-09-17 02:29:01','updated_at' => '2023-09-17 02:29:22'
            ],
            [
                'id' => '2','name' => 'Women','slug' => 'women','status' => '1','showHome' => 'Yes','category_id' => '1','created_at' => '2023-09-17 02:29:36','updated_at' => '2023-09-17 02:29:36'
            ],
            [
                'id' => '3','name' => 'Unisex','slug' => 'unisex','status' => '1','showHome' => 'Yes','category_id' => '1','created_at' => '2023-09-17 03:03:00','updated_at' => '2023-09-17 03:03:00'
            ],
            [
                'id' => '4','name' => 'Basketball','slug' => 'basketball','status' => '1','showHome' => 'Yes','category_id' => '2','created_at' => '2023-09-17 03:03:22','updated_at' => '2023-09-17 03:03:22'
            ],
            [
                'id' => '5','name' => 'Cycling','slug' => 'cycling','status' => '1','showHome' => 'Yes','category_id' => '2','created_at' => '2023-09-17 03:04:01','updated_at' => '2023-09-17 03:04:01'
            ],
            [
                'id' => '6','name' => 'Dance','slug' => 'dance','status' => '1','showHome' => 'Yes','category_id' => '2','created_at' => '2023-09-17 03:04:14','updated_at' => '2023-09-17 03:04:14'
            ],
            [
                'id' => '7','name' => 'Athletic','slug' => 'athletic','status' => '1','showHome' => 'Yes','category_id' => '4','created_at' => '2023-09-17 03:04:51','updated_at' => '2023-09-17 03:04:51'
            ],
            [
                'id' => '8','name' => 'Casual','slug' => 'casual','status' => '1','showHome' => 'Yes','category_id' => '4','created_at' => '2023-09-17 03:05:03','updated_at' => '2023-09-17 03:05:03'
            ],
            [
                'id' => '9','name' => 'Sneakers','slug' => 'sneakers','status' => '1','showHome' => 'Yes','category_id' => '4','created_at' => '2023-09-17 03:05:19','updated_at' => '2023-09-17 03:05:19'
            ],
        ]);
    }
}
