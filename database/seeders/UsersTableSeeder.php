<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'ChatGPT',
            'email' => 'chat@example.com',
            'email_verified_at' => now(),
            'password' => '',
            'remember_token' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
