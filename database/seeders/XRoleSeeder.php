<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MIMAXUZ\LRoles\Models\XRoles;

class XRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        XRoles::insert([
            [
                'id'   => 1,
                'name' => 'Super Admin',
                'slug' => 'super-admin'
            ],
            [
                'id'   => 2,
                'name' => 'Administrator',
                'slug' => 'admin'
            ],
            [
                'id'   => 3,
                'name' => 'Organizer',
                'slug' => 'organizer'
            ],
            [
                'id'   => 4,
                'name' => 'Moderator',
                'slug' => 'moderator'
            ],
            [
                'id'   => 5,
                'name' => 'Publisher',
                'slug' => 'publisher'
            ],
            [
                'id'   => 6,
                'name' => 'User',
                'slug' => 'user'
            ],
            [
                'id'   => 7,
                'name' => 'Company',
                'slug' => 'company'
            ],
            [
                'id'   => 8,
                'name' => 'Guest',
                'slug' => 'guest'
            ]
        ]);
    }
}
