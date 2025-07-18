<?php

namespace Database\Seeders;

use App\Models\Projects\ProjectType as ProjectsProjectType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectsProjectType::insert([
            [
                'id' => 1,
                'user_id'        => 1,
                'name_uz'     => "Startap Loyiha",
                'name_ru'     => "Startap Loyiha",
                'name_en'     => "StartapStartap loyiha"
            ],
            [
                'id' => 2,
                'user_id'        => 1,
                'name_uz'     => "Tijoratlashtirish Loyiha",
                'name_ru'     => "Tijoratlashtirish Loyiha",
                'name_en'     => "Tijoratlashtirish loyiha"
            ],
            [
                'id' => 3,
                'user_id'        => 1,
                'name_uz'     => "Ilmiy Loyiha",
                'name_ru'     => "Ilmiy Loyiha",
                'name_en'     => "Ilmiy loyiha"
            ]
        ]);
    }
}
