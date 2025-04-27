<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'customer@gmail.com',
            'role' => 'customer',
            'password' => Hash::make('123456'),
        ]);
    }
}
