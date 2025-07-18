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
        User::insert([
            [
                'id'        => 1,
                'user_type'        => 0,
                'first_name' => 'Super',
                'last_name' => 'Administrator',
                'email' => 'sa@innoweek.uz',
                'company_name' => null,
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@Admin2024')
            ],
            [
                'id'        => 2,
                'user_type'        => 0,
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'email' => 'admin@innoweek.uz',
                'company_name' => null,
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@Admin2024')
            ],
            [
                'id'        => 3,
                'user_type'        => 1,
                'first_name' => 'Startup',
                'last_name' => 'Moderator',
                'email' => 'moderator@innoweek.uz',
                'company_name' => null,
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@AdminMod2024')
            ],
            [
                'id'        => 4,
                'user_type'        => 1,
                'first_name' => 'Startup',
                'last_name' => 'Organizer',
                'email' => 'organizer@innoweek.uz',
                'company_name' => null,
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@AdminOrg2024')
            ],
            [
                'id'        => 5,
                'user_type'        => 4,
                'first_name' => 'Eshmat',
                'last_name' => 'Toshmatov',
                'email' => 'company@innoweek.uz',
                'company_name' => "TOSHKENT GULLARI MChJ",
                'company_inn' => 102202303,
                'phone' => "+99890123457",
                'status' => 'active',
                'password' => Hash::make('@Test123')
            ]
        ]);
    }
}
