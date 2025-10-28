<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->updateOrInsert(
            ['email' => 'mamsyar1404@gmail.com'],
            [
                'name' => 'Amsyar',
                'email' => 'mamsyar1404@gmail.com',
                'role' => 'teacher',
                'password' => Hash::make('Amsyarazmi123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('users')->updateOrInsert(
            ['email' => 'amsyarhansem@gmail.com'],
            [
                'name' => 'Ayahpin',
                'email' => 'amsyarhansem@gmail.com',
                'role' => 'lab_assistant',
                'password' => Hash::make('Amsyarazmi123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('users')->updateOrInsert(
            ['email' => 'siakkcool@gmail.com'],
            [
                'name' => 'Faz Ahmad',
                'email' => 'siakkcool@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('Amsyarazmi123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
