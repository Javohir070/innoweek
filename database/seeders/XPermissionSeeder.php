<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MIMAXUZ\LRoles\Models\XPermissions;

class XPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        XPermissions::insert([
            [
                'id'   => 1,
                'name' => 'Grand Access',
                'slug' => 'grand'
            ],
            [
                'id'   => 2,
                'name' => 'Create Access',
                'slug' => 'create'
            ],
            [
                'id'   => 3,
                'name' => 'Update Access',
                'slug' => 'update'
            ],
            [
                'id'   => 4,
                'name' => 'Read Access',
                'slug' => 'read'
            ],
            [
                'id'   => 5,
                'name' => 'Delete Access',
                'slug' => 'delete'
            ]
        ]);
    }
}
