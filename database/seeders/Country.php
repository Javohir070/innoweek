<?php

namespace Database\Seeders;

use App\Models\Regions\Country as RegionsCountry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Country extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegionsCountry::insert([
            [
                'user_id'        => 1,
                'name_uz'     => "O'zbekiston",
                'name_ru'     => "O'zbekiston",
                'name_en'     => "O'zbekiston"
            ]
        ]);
    }
}
