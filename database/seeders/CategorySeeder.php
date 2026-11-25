<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $shoes = Category::create(['name' => 'Обувь']);
        $accessories = Category::create(['name' => 'Аксессуары']);

        Subcategory::create(['cat_id' => $shoes->id, 'name' => 'Кроссовки']);
        Subcategory::create(['cat_id' => $shoes->id, 'name' => 'Ботинки']);
        Subcategory::create(['cat_id' => $shoes->id, 'name' => 'Туфли']);
        Subcategory::create(['cat_id' => $shoes->id, 'name' => 'Сандалии']);

        Subcategory::create(['cat_id' => $accessories->id, 'name' => 'Носки']);
        Subcategory::create(['cat_id' => $accessories->id, 'name' => 'Шнурки']);
    }
}