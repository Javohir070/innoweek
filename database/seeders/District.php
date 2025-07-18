<?php

namespace Database\Seeders;

use App\Models\Regions\District as RegionsDistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class District extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegionsDistrict::insert([
            [
                'region_id'        => 1,
                'name_uz'     => "Chilonzor tumani",
                'name_ru'     => "Chilonzor tumani",
                'name_en'     => "Chilonzor tumani"
            ]
        ]);
    }
}
