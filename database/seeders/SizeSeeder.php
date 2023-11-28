<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sizes')->insert([
            ['id' => 1 ,'size' => 33,'created_at' => '2023-09-26 05:35:42','updated_at' => '2023-09-26 05:49:10'],
            ['id' => 2 ,'size' => 41,'created_at' => '2023-09-26 05:42:26','updated_at' => '2023-09-26 05:42:26'],
            ['id' => 3 ,'size' => 40,'created_at' => '2023-09-26 05:42:32','updated_at' => '2023-09-26 05:42:32'],
            ['id' => 4 ,'size' => 42,'created_at' => '2023-09-26 05:43:27','updated_at' => '2023-09-26 05:43:27'],
            ['id' => 5 ,'size' => 21,'created_at' => '2023-09-26 05:43:34','updated_at' => '2023-09-26 05:43:34'],
            ['id' => 6 ,'size' => 32,'created_at' => '2023-09-26 05:43:42','updated_at' => '2023-09-26 05:43:42']
        ]);
    }
}
