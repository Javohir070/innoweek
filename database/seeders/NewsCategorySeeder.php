<?php

namespace Database\Seeders;

use App\Models\News\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsCategory::insert([
            [
                'id'        => 1,
                'user_id'        => 1,
                'name_uz'     => "Asosiy yangiliklar",
                'name_ru'     => "Главные новости",
                'name_en'     => "Main news"
            ],
            [
                'id'        => 2,
                'user_id'        => 1,
                'name_uz'     => "Voqealar",
                'name_ru'     => "События",
                'name_en'     => "Events"
            ]
        ]);
    }
}
