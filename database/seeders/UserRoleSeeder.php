<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'alumni',
            'password' => Hash::make('alumni123'),
            'role' => 'alumni',
        ]);

        User::create([
            'username' => 'siswa',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);
    }
}
