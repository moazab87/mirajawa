<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\InformationBlock;
use Illuminate\Database\Seeder;

class InformationBlockSeeder extends Seeder
{
    public function run(): void
    {
        $payload = [
            'name'        => ['ar' => 'سلسلة التبريد', 'en' => 'Cold Chain', 'ja' => 'コールドチェーン'],
            'description' => ['ar' => 'نحافظ على جودة المنتجات أثناء النقل', 'en' => 'We preserve product quality during transport', 'ja' => '輸送中の品質を維持します'],
            'status'      => GeneralStatusEnum::ACTIVE->value,
        ];

        $item = InformationBlock::all()->first(fn ($b) => $b->getTranslation('name', 'en') === 'Cold Chain');
        $item ? $item->update($payload) : InformationBlock::create($payload);
    }
}
