<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\History;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        $payload = [
            'name'        => ['ar' => 'تأسيس الشركة', 'en' => 'Company Founded', 'ja' => '会社設立'],
            'description' => ['ar' => 'بداية رحلتنا في تصنيع المنتجات الغذائية', 'en' => 'The start of our food manufacturing journey', 'ja' => '食品製造の旅の始まり'],
            'status'      => GeneralStatusEnum::ACTIVE->value,
        ];

        $item = History::all()->first(fn ($h) => $h->getTranslation('name', 'en') === 'Company Founded');
        $item ? $item->update($payload) : History::create($payload);
    }
}
