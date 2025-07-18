<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id'        => 10,
                'user_type'        => 1,
                'first_name' => 'Otabek',
                'last_name' => 'Qahhorov',
                'email' => 'ilmiy@innoweek.uz',
                'company_name' => "DAVLAT ILMIY DASTURLARINI SHAKLLANTIRISH VA MONITORING QILISH BOSHQARMASI",
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@Ilmiy2024')
            ],
            [
                'id'        => 11,
                'user_type'        => 1,
                'first_name' => 'Jamshid',
                'last_name' => 'Xoliqov',
                'email' => 'tijorat@innoweek.uz',
                'company_name' => "TIJORATLASHTIRISH VA TEXNOLOGIYALARNI TRANFERINI RIVOJLANTIRISH BOSHQARMASII",
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@Tijorat2024')
            ],
            [
                'id'        => 12,
                'user_type'        => 1,
                'first_name' => 'Azizbek',
                'last_name' => 'Ilhomov',
                'email' => 'startup@innoweek.uz',
                'company_name' => "STARTAP EKOTIZIMINI RIVOJLANTIRISH BO'LIMI",
                'company_inn' => null,
                'phone' => null,
                'status' => 'active',
                'password' => Hash::make('@Startup2024')
            ]
        ]);

        UserRole::insert([
            [
                'user_id'        => 10,
                'x_roles_id' => 4
            ],
            [
                'user_id'        => 11,
                'x_roles_id' => 4
            ],
            [
                'user_id'        => 12,
                'x_roles_id' => 4
            ]
        ]);
    }
}
