<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample sliders
        Slider::create([
            // 'link'      => 'https://example.com',
            // 'order'     => 1,
            'is_active' => true,
        ]);

        Slider::create([
            // 'link'      => 'https://example.com',
            // 'order'     => 2,
            'is_active' => true,
        ]);
    }
}

