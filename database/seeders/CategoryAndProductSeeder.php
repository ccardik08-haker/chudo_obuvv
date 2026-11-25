<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class CategoryAndProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Создаем Категории
        $catDet = Category::create(['name' => 'Детская обувь']);
        $catWom = Category::create(['name' => 'Женская обувь']);
        $catMen = Category::create(['name' => 'Мужская обувь']);

        // 2. Создаем Подкатегории
        $subCross = Subcategory::create(['cat_id' => $catDet->id, 'name' => 'Кроссовки']);
        $subBoots = Subcategory::create(['cat_id' => $catDet->id, 'name' => 'Сапоги']);
        $subSand = Subcategory::create(['cat_id' => $catDet->id, 'name' => 'Босоножки']);
        
        $subWomCross = Subcategory::create(['cat_id' => $catWom->id, 'name' => 'Кроссовки']);
        $subWomBoots = Subcategory::create(['cat_id' => $catWom->id, 'name' => 'Сапоги']);

        // 3. Создаем Товары (примеры из вашего списка)
        // Указываем size_id = 1 (это 18 размер, просто чтобы поле не было пустым), 
        // но реальные размеры и остатки мы привяжем в Stock-сидере.
        
        $size18 = Size::where('size', '18')->first();

        Product::create([
            'cat_id' => $catDet->id,
            'subcat_id' => $subCross->id,
            'size_id' => $size18->id,
            'name' => 'Кроссовки детские «Звёздочка» экокожа',
            'manufacture' => 'Малыш-Спорт',
            'description' => 'Кроссовки детские «Звёздочка» экокожа. Производитель: ООО «Малыш-Спорт», г. Смоленск',
            'composition' => 'Верх — экокожа, подкладка — хлопок 100%, подошва — ПВХ',
            'price' => 2190,
            'quantity' => 20, // Берем общее количество из Stock
            'image' => 'images/IMG_KS_195217.png', // Путь к вашей картинке
        ]);

        Product::create([
            'cat_id' => $catWom->id,
            'subcat_id' => $subWomBoots->id,
            'size_id' => $size18->id,
            'name' => 'Сапоги зимние натуральная кожа',
            'manufacture' => 'Барбари',
            'description' => 'Сапоги женские зимние, нескользящая, устойчивая подошва, натуральный мех.',
            'composition' => 'Верх — натуральная кожа, подкладка — евромех, подошва — резина',
            'price' => 25000,
            'quantity' => 24,
            'image' => 'images/IMG_WB_170905.png',
        ]);

        // ДОБАВЬТЕ СЮДА ОСТАЛЬНЫЕ ТОВАРЫ ПО АНАЛОГИИ
    }
}