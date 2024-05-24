<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test Kullanıcı',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'kullanıcı',
            'email' => 'kullanici@example.com',
            'password' => Hash::make('password12345'),
        ]);
    }
}
