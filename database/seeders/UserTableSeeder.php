<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed
        DB::table('users')->insert([
            [//super admin
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('SuperAdmin123@'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'role' => 2,
                'main_role' => 2,
            ],
            [//admin
                'name' => 'Regie',
                'email' => 'regie@gmail.com',
                'password' => Hash::make('Regie123@'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'role' => 2,
                'main_role' => 1,
            ],
            [//user
                'name' => 'John Mark',
                'email' => 'johnmark@gmail.com',
                'password' => Hash::make('Johnmark123@'),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
                'role' => 1,
                'main_role' => 1,
            ]


        ]);
    }
}
