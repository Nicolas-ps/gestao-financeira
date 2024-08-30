<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Alimentação'],
            ['name' => 'Transporte'],
            ['name' => 'Educação'],
            ['name' => 'Saúde'],
            ['name' => 'Lazer'],
            ['name' => 'Moradia'],
            ['name' => 'Vestuário'],
            ['name' => 'Outros'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}