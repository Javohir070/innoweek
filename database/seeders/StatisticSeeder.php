<?php

namespace Database\Seeders;

use App\Models\News\NewsCategory;
use App\Models\Statistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statistic::insert([
            [
                'id'        => 1,
                'user_id'        => 1,
                'name_uz'     => "Maydon",
                'name_ru'     => "",
                'name_en'     => "",
                'statistic'   => "10 000",
                "icon"        => asset("front/image/svg/area-oq.svg")
            ],
            [
                'id'        => 2,
                'user_id'        => 1,
                'name_uz'     => "Tashrif buyuruvchilar",
                'name_ru'     => "",
                'name_en'     => "",
                'statistic'   => "11 K+",
                "icon"        => asset("front/image/svg/visitor-oq.svg")
            ],
            [
                'id'        => 3,
                'user_id'        => 1,
                'name_uz'     => "Startaplar",
                'name_ru'     => "",
                'name_en'     => "",
                'statistic'   => "100+",
                "icon"        => asset("front/image/svg/startup-oq.svg")
            ],
            [
                'id'        => 4,
                'user_id'        => 1,
                'name_uz'     => "Ishtirokchilar",
                'name_ru'     => "",
                'name_en'     => "",
                'statistic'   => "500+",
                "icon"        => asset("front/image/svg/exhibitor-oq.svg")
            ],
            [
                'id'        => 5,
                'user_id'        => 1,
                'name_uz'     => "Davlatlar",
                'name_ru'     => "",
                'name_en'     => "",
                'statistic'   => "10+",
                "icon"        => asset("front/image/svg/countries-oq.svg")
            ],
        ]);
    }
}
