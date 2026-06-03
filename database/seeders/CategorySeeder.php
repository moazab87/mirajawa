<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => ['ar' => 'فواكه مجمدة', 'en' => 'Frozen Fruits', 'ja' => '冷凍果物'], 'color' => '#D72638'],
            ['name' => ['ar' => 'خضروات مجمدة', 'en' => 'Frozen Vegetables', 'ja' => '冷凍野菜'], 'color' => '#2E8B57'],
            ['name' => ['ar' => 'منتجات مجففة', 'en' => 'Dehydrated Products', 'ja' => '乾燥製品'], 'color' => '#C58B2B'],
        ];

        foreach ($categories as $data) {
            $category = Category::all()->first(
                fn ($item) => $item->getTranslation('name', 'en') === $data['name']['en']
            );

            $payload = [
                'name'        => $data['name'],
                'description' => ['ar' => null, 'en' => null, 'ja' => null],
                'color'       => $data['color'],
                'status'      => GeneralStatusEnum::ACTIVE->value,
            ];

            $category ? $category->update($payload) : Category::create($payload);
        }
    }
}
