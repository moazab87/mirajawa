<?php

namespace Database\Seeders;

use App\Enums\GeneralStatusEnum;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => [
                    'ar' => 'هل يمكن طلب كتالوج المنتجات؟',
                    'en' => 'Can I request a product catalog?',
                    'ja' => '製品カタログを請求できますか？',
                ],
                'answer' => [
                    'ar' => 'نعم، يمكنك إرسال طلب معلومات من خلال نموذج طلب المعلومات وسيقوم فريقنا بالتواصل معك.',
                    'en' => 'Yes, you can submit an information request form and our team will contact you.',
                    'ja' => 'はい、情報リクエストフォームを送信すると、担当チームよりご連絡いたします。',
                ],
            ],
            [
                'question' => [
                    'ar' => 'هل المنتجات متاحة للتصدير؟',
                    'en' => 'Are the products available for export?',
                    'ja' => '製品は輸出可能ですか？',
                ],
                'answer' => [
                    'ar' => 'نعم، المنتجات مهيأة لتلبية احتياجات العملاء والأسواق المختلفة.',
                    'en' => 'Yes, products are prepared to meet different customer and market requirements.',
                    'ja' => 'はい、製品はさまざまなお客様と市場の要件に対応できるよう準備されています。',
                ],
            ],
        ];

        foreach ($faqs as $faq) {
            $exists = Faq::all()->first(fn ($item) => $item->getTranslation('question', 'en') === $faq['question']['en']);
            $exists ? $exists->update(array_merge($faq, ['status' => GeneralStatusEnum::ACTIVE->value])) : Faq::create(array_merge($faq, ['status' => GeneralStatusEnum::ACTIVE->value]));
        }
    }
}
