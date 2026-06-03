<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Category;
use App\Models\ProductGroup;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'Frozen Fruits' => ['ar' => 'فراولة', 'en' => 'Strawberries', 'ja' => 'いちご'],
            'Frozen Vegetables' => ['ar' => 'خضروات مشكلة', 'en' => 'Mixed Vegetables', 'ja' => 'ミックス野菜'],
            'Dehydrated Products' => ['ar' => 'أعشاب مجففة', 'en' => 'Dried Herbs', 'ja' => '乾燥ハーブ'],
        ];

        foreach ($map as $categoryEn => $name) {
            $category = Category::all()->first(fn ($c) => $c->getTranslation('name', 'en') === $categoryEn);
            if (!$category) {
                continue;
            }

            $group = ProductGroup::where('category_id', $category->id)->get()->first(
                fn ($item) => $item->getTranslation('name', 'en') === $name['en']
            );

            $payload = ['name' => $name, 'status' => GeneralStatusEnum::ACTIVE->value, 'category_id' => $category->id];
            $group ? $group->update($payload) : ProductGroup::create($payload);
        }
    }
}
