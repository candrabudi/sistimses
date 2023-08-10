<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Sistimses',
            'email' => 'adminsistimses@example.com',
            'password' => Hash::make('RandomAdminSistimses!@#$'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'User Sistimses',
            'email' => 'usersistimses@example.com',
            'password' => Hash::make('RandomUserSistimses!@#$'),
            'role' => 'User',
        ]);
    }
}
