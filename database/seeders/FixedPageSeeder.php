<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\FixedPage;
use Illuminate\Database\Seeder;

class FixedPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'privacy-policy' => ['ar' => 'سياسة الخصوصية', 'en' => 'Privacy Policy', 'ja' => 'プライバシーポリシー'],
            'our-factory' => ['ar' => 'مصنعنا', 'en' => 'Our Factory', 'ja' => '私たちの工場'],
            'welcome' => ['ar' => 'ترحيب', 'en' => 'Welcome', 'ja' => 'ようこそ'],
            'history' => ['ar' => 'تاريخ', 'en' => 'History', 'ja' => '沿革'],
            'why-us' => ['ar' => 'لماذا نحن', 'en' => 'Why Us', 'ja' => '私たちが選ばれる理由'],
            'products' => ['ar' => 'منتجات', 'en' => 'Products', 'ja' => '製品'],
            'company-information' => ['ar' => 'معلومات الشركة', 'en' => 'Company Information', 'ja' => '会社情報'],
            'about-us' => ['ar' => 'عنا', 'en' => 'About Us', 'ja' => '私たちについて'],
            'information' => ['ar' => 'معلومات', 'en' => 'Information', 'ja' => '情報'],
            'business' => ['ar' => 'الأعمال', 'en' => 'Business', 'ja' => '事業内容'],
            'greetings' => ['ar' => 'تحيات', 'en' => 'Greetings', 'ja' => 'ご挨拶'],
        ];

        foreach ($pages as $slug => $name) {
            FixedPage::updateOrCreate(
                ['slug' => $slug],
                [
                    'name'        => $name,
                    'sub_title'   => ['ar' => null, 'en' => null, 'ja' => null],
                    'description' => ['ar' => null, 'en' => null, 'ja' => null],
                    'image'       => null,
                    'status'      => GeneralStatusEnum::ACTIVE->value,
                ]
            );
        }
    }
}
