<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $payload = [
            'title'       => ['ar' => 'مرحباً بكم', 'en' => 'Welcome to Mirajawa', 'ja' => 'ミラジャワへようこそ'],
            'description' => ['ar' => 'منتجات عالية الجودة', 'en' => 'Premium quality products', 'ja' => '高品質な製品'],
            'status'      => GeneralStatusEnum::ACTIVE->value,
        ];

        $slider = Slider::first();
        $slider ? $slider->update($payload) : Slider::create($payload);
    }
}
