<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Станимир',
                'last_name' => 'Кънчев',
                'phone' => '0899334333',
                'email' => 'user@abv.bg',
                'password' => Hash::make('123456'),
                'is_admin' => false,
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'admin',
                'phone' => '0899334333',
                'email' => 'admin@abv.bg',
                'password' => Hash::make('123456'),
                'is_admin' => true,
            ]
        ]);
    }
}
