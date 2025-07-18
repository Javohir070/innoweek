<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            XRoleSeeder::class,
            XPermissionSeeder::class,
            UserRole::class,
            Country::class,
            Region::class,
            District::class,
            ProjectType::class,
            ProjectCategory::class,
            Organizer::class,
        ]);
    }
}
