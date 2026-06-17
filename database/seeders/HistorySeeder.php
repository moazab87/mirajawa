<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\History;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            [
                'year' => 2011,
                'name' => [
                    'ar' => 'بداية المسيرة',
                    'en' => 'Beginning of the Journey',
                    'ja' => '事業の歩みの始まり',
                ],
                'description' => [
                    'ar' => 'بدأت الخبرات العملية وبناء المعرفة بالسوق المصري والمنتجات اليابانية.',
                    'en' => 'Practical experience began, building knowledge of the Egyptian market and Japanese products.',
                    'ja' => '実務経験が始まり、エジプト市場と日本製品への理解を深めました。',
                ],
            ],
            [
                'year' => 2020,
                'name' => [
                    'ar' => 'الانتقال إلى اليابان',
                    'en' => 'Moving to Japan',
                    'ja' => '日本への来日',
                ],
                'description' => [
                    'ar' => 'جاءت مرحلة الانتقال إلى اليابان وبداية التفكير في بناء جسر تجاري بين مصر واليابان.',
                    'en' => 'This stage marked the move to Japan and the beginning of building a business bridge between Egypt and Japan.',
                    'ja' => '日本へ渡り、エジプトと日本をつなぐビジネスの構想が始まりました。',
                ],
            ],
            [
                'year' => 2022,
                'name' => [
                    'ar' => 'بداية الشراكة',
                    'en' => 'Partnership Beginning',
                    'ja' => 'パートナーシップの始まり',
                ],
                'description' => [
                    'ar' => 'بدأت الرؤية المشتركة لتأسيس عمل يربط بين السوق المصري والياباني.',
                    'en' => 'A shared vision began to establish a business connecting the Egyptian and Japanese markets.',
                    'ja' => 'エジプトと日本の市場をつなぐ事業への共通ビジョンが生まれました。',
                ],
            ],
            [
                'year' => 2025,
                'name' => [
                    'ar' => 'تأسيس MIRAJAWA',
                    'en' => 'MIRAJAWA Established',
                    'ja' => 'MIRAJAWA設立',
                ],
                'description' => [
                    'ar' => 'تم تأسيس شركة MIRAJAWA وبدأت خطوات التعاون التجاري واستيراد المنتجات المصرية.',
                    'en' => 'MIRAJAWA was established and started its trade cooperation and Egyptian product import journey.',
                    'ja' => 'MIRAJAWAを設立し、エジプト製品の輸入と貿易協力を開始しました。',
                ],
            ],
            [
                'year' => 2026,
                'name' => [
                    'ar' => 'تطوير الأعمال',
                    'en' => 'Business Development',
                    'ja' => '事業展開',
                ],
                'description' => [
                    'ar' => 'بدأت مرحلة تطوير الأعمال وتوسيع العلاقات والشراكات بين مصر واليابان.',
                    'en' => 'The business development phase began, expanding relationships and partnerships between Egypt and Japan.',
                    'ja' => 'エジプトと日本の関係およびパートナーシップを拡大する事業展開期が始まりました。',
                ],
            ],
        ];

        foreach ($records as $record) {
            History::updateOrCreate(
                ['year' => $record['year']],
                [
                    'name' => $record['name'],
                    'description' => $record['description'],
                    'status' => GeneralStatusEnum::ACTIVE->value,
                ]
            );
        }

        History::query()
            ->whereNull('year')
            ->where('name->en', 'Company Founded')
            ->delete();
    }
}
