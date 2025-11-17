<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserRoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Temporarily disable AdminSeeder to avoid role column error in admins table
        // $this->call(AdminSeeder::class);
        $this->call(UserRoleSeeder::class);
    }
    
}
