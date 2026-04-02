<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Отключаем проверку внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Очищаем таблицу (удаляем все записи)
        Product::query()->delete();
        
        // Сбрасываем автоинкремент (опционально)
        DB::table('products')->truncate(); // или DB::statement('ALTER TABLE products AUTO_INCREMENT = 1;');
        
        $products = [
            [
                'name' => 'Fender Stratocaster',
                'slug' => 'fender-stratocaster',
                'description' => 'Классическая электрогитара американского производства. Звук, который вдохновляет.',
                'price' => 89900,
                'rent_price_per_day' => 1500,
                'brand' => 'Fender',
                'category' => 'guitars',
                'level' => 'professional',
                'image' => 'https://n.cdn.cdek.shopping/images/shopping/aIpLeQmnFpd3jhX2.webp?v=1',
            ],
            [
                'name' => 'Yamaha P-125',
                'slug' => 'yamaha-p-125',
                'description' => 'Цифровое пианино с взвешенной клавиатурой, идеально для обучения и выступлений.',
                'price' => 54900,
                'rent_price_per_day' => 800,
                'brand' => 'Yamaha',
                'category' => 'keyboards',
                'level' => 'beginner',
                'image' => 'https://avatars.mds.yandex.net/get-mpic/11225627/2a0000018b09599fe85cf99aa42d10b7c09a/orig',
            ],
            [
                'name' => 'DW Drums Collector\'s Series',
                'slug' => 'dw-drums-collectors',
                'description' => 'Профессиональная ударная установка из американского клёна.',
                'price' => 129900,
                'rent_price_per_day' => 2500,
                'brand' => 'DW',
                'category' => 'drums',
                'level' => 'professional',
                'image' => 'https://n.cdn.cdek.shopping/images/shopping/aUFSjfRYXu8WAPea.jpg?v=1',
            ],
            [
                'name' => 'Shure SM7B',
                'slug' => 'shure-sm7b',
                'description' => 'Студийный микрофон для вокала и инструментов.',
                'price' => 39900,
                'rent_price_per_day' => null,
                'brand' => 'Shure',
                'category' => 'studio',
                'level' => 'professional',
                'image' => 'https://i.ebayimg.com/images/g/ofYAAOSw3EBl7NFy/s-l1600.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
        
        // Включаем проверку обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}