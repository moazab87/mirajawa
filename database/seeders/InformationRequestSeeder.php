<?php

namespace Database\Seeders;

use App\Enums\MessageStatusEnum;
use App\Models\InformationRequest;
use Illuminate\Database\Seeder;

class InformationRequestSeeder extends Seeder
{
    public function run(): void
    {
        InformationRequest::updateOrCreate(
            ['email' => 'buyer@example.com', 'name' => 'Test Buyer'],
            [
                'company_name' => 'Import Company',
                'phone'        => '+201000000001',
                'address'      => 'Cairo, Egypt',
                'postal_code'  => '11511',
                'message'      => 'Please send us your latest product catalog.',
                'status'       => MessageStatusEnum::NEW->value,
            ]
        );
    }
}
