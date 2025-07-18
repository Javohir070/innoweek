<?php

namespace Database\Seeders;

use App\Models\UserRole as ModelsUserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUserRole::insert([
            [
                'user_id'        => 1,
                'x_roles_id'     => 1
            ],
            [
                'user_id'        => 2,
                'x_roles_id' => 2
            ],
            [
                'user_id'        => 4,
                'x_roles_id' => 3
            ],
            [
                'user_id'        => 3,
                'x_roles_id' => 4
            ]]);
    }
}
