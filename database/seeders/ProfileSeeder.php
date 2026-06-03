<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $payload = [
            'name'        => ['ar' => 'التزام بالجودة', 'en' => 'Quality Commitment', 'ja' => '品質へのこだわり'],
            'description' => ['ar' => 'نلتزم بأعلى معايير الجودة', 'en' => 'We follow the highest quality standards', 'ja' => '最高品質基準を遵守します'],
            'status'      => GeneralStatusEnum::ACTIVE->value,
        ];

        $profile = Profile::all()->first(fn ($p) => $p->getTranslation('name', 'en') === 'Quality Commitment');
        $profile ? $profile->update($payload) : Profile::create($payload);
    }
}
