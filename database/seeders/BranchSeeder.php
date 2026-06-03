<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $payload = [
            'name'        => ['ar' => 'فرع القاهرة', 'en' => 'Cairo Branch', 'ja' => 'カイロ支店'],
            'description' => ['ar' => 'فرع رئيسي للتوزيع', 'en' => 'Main distribution branch', 'ja' => '主要配送拠点'],
            'status'      => GeneralStatusEnum::ACTIVE->value,
        ];

        $branch = Branch::all()->first(fn ($b) => $b->getTranslation('name', 'en') === 'Cairo Branch');
        $branch ? $branch->update($payload) : Branch::create($payload);
    }
}
