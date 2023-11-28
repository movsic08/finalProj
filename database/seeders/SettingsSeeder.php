<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            // TWILIO_SID="ACbe46690b196ea6f1bc5b7639d21283e4"
            // TWILIO_TOKEN="48fce15b5d691fa2cfd68e053df04e88"
            // TWILIO_FROM="+639692696666"

            // $account_id = $setting->twilio_sid;
            // $auth_token = $setting->twilio_token;
            // $twilio_number = $setting->twilio_from;
            [
                "name" => "Shoeniverse",
                "logo" => "logo.jpeg",
                "twilio_sid" => "ACbe46690b196ea6f1bc5b7639d21283e4",
                "twilio_token" => "48fce15b5d691fa2cfd68e053df04e88",
                "twilio_from" => "+639692696666"
            ]
        ]);
    }
}
