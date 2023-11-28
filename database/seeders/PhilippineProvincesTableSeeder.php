<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PhilippineProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!DB::table('philippine_provinces')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/philippine_provinces.sql'));
        }
    }
}
