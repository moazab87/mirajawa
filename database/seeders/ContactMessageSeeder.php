<?php

namespace Database\Seeders;

use App\Enums\MessageStatusEnum;
use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::updateOrCreate(
            ['email' => 'client@example.com', 'name' => 'Test Client'],
            [
                'company_name' => 'Demo Company',
                'phone'        => '+201000000000',
                'message'      => 'I would like to know more about your products.',
                'status'       => MessageStatusEnum::NEW->value,
            ]
        );
    }
}
