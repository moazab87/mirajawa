<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\ContactInformation;
use Illuminate\Database\Seeder;

class ContactInformationSeeder extends Seeder
{
    public function run(): void
    {
        $payload = [
            'name'        => ['ar' => 'خدمة العملاء', 'en' => 'Customer Service', 'ja' => 'カスタマーサービス'],
            'description' => ['ar' => 'تواصل معنا', 'en' => 'Get in touch with us', 'ja' => 'お問い合わせください'],
            'phone'       => '+201000000000',
            'image'       => null,
            'status'      => GeneralStatusEnum::ACTIVE->value,
        ];

        $item = ContactInformation::all()->first(fn ($c) => $c->getTranslation('name', 'en') === 'Customer Service');
        $item ? $item->update($payload) : ContactInformation::create($payload);
    }
}
