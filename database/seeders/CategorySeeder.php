<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category' => 'Pendidikan',
            'description' => 'Kategori Pendidikan',
        ]);
        Category::create([
            'category' => 'Novel',
            'description' => 'Kategori Novel',
        ]);
        Category::create([
            'category' => 'Komik',
            'description' => 'Kategori Komik',
        ]);
    }
}
