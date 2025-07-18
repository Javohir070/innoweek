<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Organizer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id'        => 5,
                'user_type'        => 1,
                'first_name' => 'Organizator',
                'last_name' => 'Profil',
                'email' => 'organizator@innoweek.uz',
                'company_name' => "",
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@Org2024')
            ]
        ]);

        UserRole::insert([
            [
                'user_id'        => 5,
                'x_roles_id' => 3
            ]
        ]);
    }
}
