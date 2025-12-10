<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::query()->first();

        if (! $category) {
            $this->command->warn('⚠️ No categories found. Please run CategorySeeder first.');
            return;
        }

        DB::table('products')->insert([
            'name'        => json_encode(['en' => 'Sample Product', 'ja' => 'サンプル製品']),
            'description' => json_encode(['en' => 'This is a sample product description.', 'ja' => 'これはサンプル製品の説明です。']),
            'link'        => 'https://example.com/product',
            'category_id' => $category->id,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}

