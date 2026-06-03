<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        Address::updateOrCreate(
            ['address' => 'Cairo, Egypt - Head Office'],
            [
                'name'        => ['ar' => 'المقر الرئيسي', 'en' => 'Head Office', 'ja' => '本社'],
                'description' => ['ar' => 'مكتب الشركة الرئيسي', 'en' => 'Main company office', 'ja' => '本社オフィス'],
                'map_desc'    => ['ar' => 'القاهرة', 'en' => 'Cairo', 'ja' => 'カイロ'],
                'lat'         => 30.0444,
                'lng'         => 31.2357,
                'status'      => GeneralStatusEnum::ACTIVE->value,
            ]
        );
    }
}
