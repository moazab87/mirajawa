<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'phone'             => null,
            'since_year'        => '1994',
            'background_image'  => null,
        ];

        foreach ($defaults as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
