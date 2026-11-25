<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcat_id')->constrained('subcategories')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            
            $table->string('name'); // наименование
            $table->string('manufacture'); // изготовитель
            $table->text('composition')->nullable(); // состав
            $table->text('description')->nullable(); // описание
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0);
            
            // Поле для изображения (по ТЗ у модели должна быть картинка)
            $table->string('image')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};