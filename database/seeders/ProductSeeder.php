<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::all()->first(fn ($c) => $c->getTranslation('name', 'en') === 'Frozen Fruits') ?? Category::first();
        $group = ProductGroup::where('category_id', $category?->id)->first();

        if (!$category) {
            $this->command->warn('⚠️ No categories found. Run CategorySeeder first.');
            return;
        }

        $payload = [
            'name'               => ['ar' => 'فراولة مجمدة', 'en' => 'Frozen Strawberries', 'ja' => '冷凍いちご'],
            'description'        => ['ar' => 'فراولة مجمدة عالية الجودة', 'en' => 'Premium frozen strawberries', 'ja' => '高品質冷凍いちご'],
            'packaging'          => ['ar' => 'أكياس 1 كجم', 'en' => '1kg bags', 'ja' => '1kg袋'],
            'country_of_origin'  => ['ar' => 'مصر', 'en' => 'Egypt', 'ja' => 'エジプト'],
            'how_to_use'         => ['ar' => 'استخدم مباشرة من المجمد', 'en' => 'Use directly from frozen', 'ja' => '冷凍のままご使用ください'],
            'storage_conditions' => ['ar' => 'يحفظ مجمداً', 'en' => 'Keep frozen', 'ja' => '冷凍保存'],
            'expiry_date_text'   => ['ar' => '24 شهراً', 'en' => '24 months', 'ja' => '24ヶ月'],
            'harvest_season'     => ['ar' => 'الربيع', 'en' => 'Spring', 'ja' => '春'],
            'notes'              => ['ar' => null, 'en' => 'Export ready', 'ja' => '輸出対応'],
            'link'               => 'https://example.com/product',
            'category_id'        => $category->id,
            'product_group_id'   => $group?->id,
            'status'             => GeneralStatusEnum::ACTIVE->value,
        ];

        $product = Product::all()->first(fn ($p) => $p->getTranslation('name', 'en') === 'Frozen Strawberries');
        $product ? $product->update($payload) : Product::create($payload);
    }
}
