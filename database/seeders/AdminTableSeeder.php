<?php

namespace Database\Seeders;

use App\Enums\AuthTypeEnum;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name'     => 'Manager',
            'email'    => 'admin@gmail.com',
            'phone'    => '01013014910',
            'password' => 123456,
            'type'     => AuthTypeEnum::SUPER_ADMIN->value,
        ]);
    }
}
