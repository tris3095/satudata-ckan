<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'role' => 'Super Admin',
            'is_active' => true,
            'password' => Hash::make('superadmin123'),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'Admin',
            'is_active' => true,
            'password' => Hash::make('admin123'),
        ]);
    }
}
