<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([

            [
                'id' => '1','name' => 'Gender','slug' => 'gender','image' => '1.jpg','status' => '1','showHome' => 'Yes','created_at' => '2023-09-17 02:28:41','updated_at' => '2023-09-17 02:28:41'
            ],  
            [
                'id' => '2','name' => 'Activity','slug' => 'activity','image' => '2.jpg','status' => '1','showHome' => 'Yes','created_at' => '2023-09-17 02:59:52','updated_at' => '2023-09-17 02:59:52'
            ],
            [
                'id' => '3','name' => 'Season','slug' => 'season','image' => '3.jpg','status' => '1','showHome' => 'Yes','created_at' => '2023-09-17 03:00:54','updated_at' => '2023-09-17 03:00:55'
            ],
            [
                'id' => '4','name' => 'Type','slug' => 'type','image' => '4.jpg','status' => '1','showHome' => 'Yes','created_at' => '2023-09-17 03:01:15','updated_at' => '2023-09-17 03:01:16'
            ],

        ]);
    }
}
