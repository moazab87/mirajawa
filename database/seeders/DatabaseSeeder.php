<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            SettingsSeeder::class,
            CategorySeeder::class,
            ProductGroupSeeder::class,
            FixedPageSeeder::class,
            ProductSeeder::class,
            SliderSeeder::class,
            SocialSeeder::class,
            AddressSeeder::class,
            BranchSeeder::class,
            FaqSeeder::class,
            ContactMessageSeeder::class,
            InformationRequestSeeder::class,
            ProfileSeeder::class,
            HistorySeeder::class,
            ContactInformationSeeder::class,
            InformationBlockSeeder::class,
        ]);
    }
}
