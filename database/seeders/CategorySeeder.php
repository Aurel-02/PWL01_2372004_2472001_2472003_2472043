<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Musik & Konser']);
        \App\Models\Category::create(['name' => 'Teknologi & Inovasi']);
        \App\Models\Category::create(['name' => 'Workshop & Edukasi']);
        \App\Models\Category::create(['name' => 'Olahraga & Outdoor']);
        \App\Models\Category::create(['name' => 'Pameran & Seni']);
    }
}
