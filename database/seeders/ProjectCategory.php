<?php

namespace Database\Seeders;

use App\Models\Projects\ProjectCategory as ProjectsProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectsProjectCategory::insert([
            [
                'id' => 1,
                'user_id'        => 1,
                'name_uz'     => "Barcha turdagi loyihalar",
                'name_ru'     => "Barcha turdagi loyihalar",
                'name_en'     => "Barcha turdagi loyihalar"
            ],
            [
                'id' => 2,
                'user_id'        => 1,
                'name_uz'     => "Biologik Loyiha",
                'name_ru'     => "Biologik Loyiha",
                'name_en'     => "Biologik loyiha"
            ]
        ]);
    }
}
