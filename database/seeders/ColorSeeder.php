<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([
            [ 'id' => 1, 'name' => 'Blue','slug' => 'blue','color' => '#003DFF','created_at' => '2023-09-26 04:42:50','updated_at' => '2023-09-26 04:42:50'],
            [ 'id' => 2, 'name' => 'Green','slug' => 'green','color' => '#12FB06','created_at' => '2023-09-26 05:16:16','updated_at' => '2023-09-26 05:16:16'],
            [ 'id' => 3, 'name' => 'Dark Blue','slug' =>  'dark-blue','color' =>  '#0A2AB4','created_at' =>  '2023-09-26 07:55:48', 'updated_at' =>  '2023-09-26 07:55:48'],
            [ 'id' =>  4, 'name' => 'Orange', 'slug' =>  'orange', 'color' => '#F98216', 'created_at' => '2023-09-26 07:56:04', 'updated_at' => '2023-09-26 07:56:04'],
            [ 'id' => 5, 'name' => 'White', 'slug' => 'white', 'color' => '#FFFFFF', 'created_at' => '2023-09-26 07:56:31', 'updated_at' => '2023-09-26 07:56:31']
        ]);
    }
}
