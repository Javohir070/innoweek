<?php

namespace Database\Seeders;

use App\Models\Regions\Region as RegionsRegion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Region extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegionsRegion::insert([
            [
                'id'        => 1,
                'name_uz'     => "Toshkent Shahar",
                'name_ru'     => "Toshkent Shahar",
                'name_en'     => "Toshkent Shahar"
            ]
        ]);
    }
}
