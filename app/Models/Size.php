<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['size'];

    // Размер встречается во многих товарах
    public function products()
    {
        return $this->hasMany(Product::class, 'size_id');
    }

    // Заказов больше нет — связь size_id из orders удалена в блоке 1.
    // Если где-то остался старый код с $size->orders — он должен быть удалён.
}