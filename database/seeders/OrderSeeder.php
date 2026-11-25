<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Найдем пользователя Сидорову Анну
        $anna = User::where('login', 'asidorova')->first();
        // Найдем кроссовки Звездочка
        $shoes = Product::where('name', 'like', '%Звёздочка%')->first();
        
        // Найдем размер 20
        $size20 = Size::where('size', '20')->first();

        Order::create([
            'user_id' => $anna->id,
            'product_id' => $shoes->id,
            'size_id' => $size20->id,
            'date' => '2026-04-02 00:00:00',
            'quantity' => 1,
            'total_price' => 2190,
            'customer_fullname' => 'Сидорова Анна Дмитриевна',
        ]);
    }
}