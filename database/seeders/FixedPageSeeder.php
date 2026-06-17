<?php

namespace Database\Seeders;

use App\Enums\FixedPageSlugEnum;
use App\Enums\GeneralStatusEnum;
use App\Models\FixedPage;
use Illuminate\Database\Seeder;

class FixedPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            FixedPageSlugEnum::WELCOME->value => [
                'name' => ['ar' => 'ترحيب', 'en' => 'Welcome', 'ja' => 'ようこそ'],
                'sub_title' => [
                    'ar' => 'شريككم الموثوق في استيراد وتوريد المنتجات الغذائية اليابانية',
                    'en' => 'Your trusted partner in Japanese food import and distribution',
                    'ja' => '日本食品の輸入・流通における信頼のパートナー',
                ],
                'description' => [
                    'ar' => '<p>مرحباً بكم في ميراجاوا. نربط بين أسواق الشرق الأوسط وشمال أفريقيا وأفضل المنتجات الغذائية اليابانية، مع التزام بالجودة والامتثال والخدمة المهنية للشركات والموزعين.</p>',
                    'en' => '<p>Welcome to MIRAJAWA. We connect Middle East and North Africa markets with premium Japanese food products, delivering quality, compliance, and professional service for businesses and distributors.</p>',
                    'ja' => '<p>MIRAJAWAへようこそ。中東・北アフリカ市場と日本の優れた食品を結び、品質・コンプライアンス・プロフェッショナルなサービスを企業・流通業者に提供します。</p>',
                ],
            ],
            FixedPageSlugEnum::ABOUT_US->value => [
                'name' => ['ar' => 'عنا', 'en' => 'About Us', 'ja' => '私たちについて'],
                'sub_title' => [
                    'ar' => 'خبرة في الاستيراد الغذائي وخدمة الشركات',
                    'en' => 'Experience in food import and B2B service',
                    'ja' => '食品輸入とB2Bサービスの実績',
                ],
                'description' => [
                    'ar' => '<p>We are an import company dedicated to delivering premium frozen strawberries and frozen vegetables from Egypt to customers across Japan.
                                Egypt’s abundant sunshine and fertile soil make it one of the world’s most renowned regions for strawberry cultivation. Fruits and vegetables harvested at peak ripeness are rapidly frozen to preserve their freshness, flavor, and nutritional value before being shipped to Japan.

                                By working directly with local producers, we verify cultivation practices, processing methods, and quality control standards to ensure that every product meets our expectations. Our focus is not on price competition, but on offering products that customers can choose with confidence and trust over the long term.

                                Our mission is simple:
                                to create a direct and honest connection between the places where food is grown and the people who enjoy it.</p>',
                    'en' => '<p>We are an import company dedicated to delivering premium frozen strawberries and frozen vegetables from Egypt to customers across Japan.
                                Egypt’s abundant sunshine and fertile soil make it one of the world’s most renowned regions for strawberry cultivation. Fruits and vegetables harvested at peak ripeness are rapidly frozen to preserve their freshness, flavor, and nutritional value before being shipped to Japan.

                                By working directly with local producers, we verify cultivation practices, processing methods, and quality control standards to ensure that every product meets our expectations. Our focus is not on price competition, but on offering products that customers can choose with confidence and trust over the long term.

                                Our mission is simple:
                                to create a direct and honest connection between the places where food is grown and the people who enjoy it.</p>',
                    'ja' => '<p>私たちはエジプトから高品質な冷凍イチゴ・冷凍野菜を直輸入し、日本のお客様へお届けする輸入会社です。
                                エジプトは豊富な日照時間と肥沃な土壌に恵まれ、世界的にも評価の高いイチゴの産地です。
                                収穫された果実や野菜は鮮度が高い状態で急速冷凍され、鮮度・風味・栄養を閉じ込めたまま日本へ届けられます。
                                私たちは現地生産者と直接つながり、栽培方法・加工工程・品質管理を確認したうえで輸入を行っています。
                                価格競争を目的とするのではなく、安心して選ばれ、長く信頼される商品をお届けすることを大切にしています。
                                食を通じて、生産地と消費地をまっすぐにつなぐ。
                                それが私たちの使命です。</p>',
                ],
            ],
            FixedPageSlugEnum::COMPANY_INFORMATION->value => [
                'name' => ['ar' => 'معلومات الشركة', 'en' => 'Company Information', 'ja' => '会社情報'],
                'sub_title' => [
                    'ar' => 'نظرة عامة على الشركة والهيكل التنظيمي',
                    'en' => 'Corporate overview and organizational profile',
                    'ja' => '企業概要と組織プロフィール',
                ],
                'description' => [
                    'ar' => '<p><strong>الاسم:</strong> ميراجاوا للاستيراد والتجارة</p><p><strong>النشاط:</strong> استيراد وتوزيع المنتجات الغذائية اليابانية</p><p><strong>الأسواق المستهدفة:</strong> مصر، الشرق الأوسط، وشمال أفريقيا</p><p>نلتزم بمعايير السلامة الغذائية والوثائق التنظيمية المطلوبة لكل سوق نخدمه.</p>',
                    'en' => '<p><strong>Company:</strong> MIRAJAWA Import & Trading</p><p><strong>Activity:</strong> Import and distribution of Japanese food products</p><p><strong>Markets:</strong> Egypt, Middle East, and North Africa</p><p>We comply with food safety standards and regulatory documentation required for each market we serve.</p>',
                    'ja' => '<p><strong>会社名:</strong> MIRAJAWA Import & Trading</p><p><strong>事業内容:</strong> 日本食品の輸入・流通</p><p><strong>対象市場:</strong> エジプト、中東、北アフリカ</p><p>各市場で求められる食品安全基準と規制書類に準拠しています。</p>',
                ],
            ],
            FixedPageSlugEnum::GREETINGS->value => [
                'name' => ['ar' => 'تحيات', 'en' => 'Greetings', 'ja' => 'ご挨拶'],
                'sub_title' => [
                    'ar' => 'رسالة من الإدارة',
                    'en' => 'A message from management',
                    'ja' => '経営陣からのメッセージ',
                ],
                'description' => [
                    'ar' => '<p>يسعدنا أن نرحب بكم في ميراجاوا. هدفنا أن نكون الجسر الذي ينقل أصالة المنتجات اليابانية إلى عملائنا في المنطقة، مع خدمة موثوقة تدعم نمو أعمالكم.</p><p>نشكركم على ثقتكم ونتطلع إلى شراكة طويلة الأمد.</p>',
                    'en' => '<p>We are pleased to welcome you to MIRAJAWA. Our goal is to be the bridge that brings authentic Japanese products to our clients in the region, with reliable service that supports your business growth.</p><p>Thank you for your trust—we look forward to a long-term partnership.</p>',
                    'ja' => '<p>MIRAJAWAへようこそ。日本の本格的な商品を地域のお客様にお届けし、信頼できるサービスでビジネスの成長を支える架け橋となることを目指しています。</p><p>ご信頼いただきありがとうございます。長期的なパートナーシップを楽しみにしております。</p>',
                ],
            ],
            FixedPageSlugEnum::BUSINESS->value => [
                'name' => ['ar' => 'الأعمال', 'en' => 'Business', 'ja' => '事業内容'],
                'sub_title' => [
                    'ar' => 'استيراد، تخزين، وتوزيع للشركات',
                    'en' => 'Import, storage, and B2B distribution',
                    'ja' => '輸入・保管・B2B流通',
                ],
                'description' => [
                    'ar' => '<p>تشمل أعمالنا اختيار المنتجات من اليابان، وإدارة سلسلة التوريد، والتخزين المبرد عند الحاجة، والتوزيع للموزعين والمطاعم وسلاسل البيع بالتجزئة.</p><p>نوفر أيضاً دعماً للتسعير والعينات والمعلومات التقنية للمنتجات.</p>',
                    'en' => '<p>Our business covers product sourcing from Japan, supply chain management, cold storage when required, and distribution to wholesalers, restaurants, and retail chains.</p><p>We also support pricing, sampling, and technical product information.</p>',
                    'ja' => '<p>日本からの商品調達、サプライチェーン管理、必要に応じた冷蔵保管、卸・飲食・小売チェーンへの流通を行っています。</p><p>価格、サンプル、商品技術情報のサポートも提供します。</p>',
                ],
            ],
            FixedPageSlugEnum::PRODUCTS->value => [
                'name' => ['ar' => 'منتجات', 'en' => 'Products', 'ja' => '製品'],
                'sub_title' => [
                    'ar' => 'كتالوج منتجات غذائية يابانية للشركات',
                    'en' => 'Japanese food catalog for businesses',
                    'ja' => '法人向け日本食品カタログ',
                ],
                'description' => [
                    'ar' => '<p>استعرض مجموعتنا من المنتجات الغذائية اليابانية المصنفة حسب الفئة ومجموعة المنتج. يمكنكم طلب معلومات تفصيلية أو عينات عبر نموذج طلب المعلومات.</p>',
                    'en' => '<p>Browse our range of Japanese food products organized by category and product group. Request detailed information or samples through our information request form.</p>',
                    'ja' => '<p>カテゴリーと製品グループ別に整理された日本食品をご覧ください。詳細情報やサンプルは情報リクエストフォームからお問い合わせください。</p>',
                ],
            ],
            FixedPageSlugEnum::HISTORY->value => [
                'name' => ['ar' => 'تاريخ', 'en' => 'History', 'ja' => '沿革'],
                'sub_title' => [
                    'ar' => 'محطات في مسيرة ميراجاوا',
                    'en' => 'Milestones in MIRAJAWA\'s journey',
                    'ja' => 'MIRAJAWAの歩み',
                ],
                'description' => [
                    'ar' => '<p>بدأت ميراجاوا برؤية واضحة: تقديم منتجات يابانية عالية الجودة للسوق الإقليمي. على مر السنين وسّعنا محفظتنا وشراكاتنا لتشمل فئات متعددة من الأغذية المبردة والمجمدة والجافة.</p>',
                    'en' => '<p>MIRAJAWA started with a clear vision: bringing high-quality Japanese products to the regional market. Over the years we expanded our portfolio and partnerships across chilled, frozen, and dry food categories.</p>',
                    'ja' => '<p>MIRAJAWAは高品質な日本商品を地域市場に届けるという明確なビジョンから始まりました。冷蔵・冷凍・乾物など多様な食品カテゴリーへ事業を拡大してきました。</p>',
                ],
            ],
            FixedPageSlugEnum::OUR_FACTORY->value => [
                'name' => ['ar' => 'مصنعنا', 'en' => 'Our Factory', 'ja' => '私たちの工場'],
                'sub_title' => [
                    'ar' => 'مرافق الشركاء والتعبئة والتخزين',
                    'en' => 'Partner facilities, packing, and storage',
                    'ja' => 'パートナー施設・梱包・保管',
                ],
                'description' => [
                    'ar' => '<p>نعمل مع مصانع وشركاء معتمدين في اليابان ومنطقة الخدمة لضمان جودة التعبئة والتخزين والشحن. تخضع مرافقنا وشركاؤنا لمعايير نظافة وسلامة غذائية صارمة.</p>',
                    'en' => '<p>We work with certified factories and partners in Japan and our service region to ensure quality packing, storage, and shipping. Our facilities and partners follow strict hygiene and food safety standards.</p>',
                    'ja' => '<p>日本およびサービス地域の認定工場・パートナーと連携し、梱包・保管・輸送の品質を確保しています。施設とパートナーは厳格な衛生・食品安全基準に従っています。</p>',
                ],
            ],
            FixedPageSlugEnum::INFORMATION->value => [
                'name' => ['ar' => 'معلومات', 'en' => 'Information', 'ja' => '情報'],
                'sub_title' => [
                    'ar' => 'تواصل معنا أو اطلب معلومات عن المنتجات',
                    'en' => 'Contact us or request product information',
                    'ja' => 'お問い合わせ・製品情報のご請求',
                ],
                'description' => [
                    'ar' => '<p>للاستفسارات التجارية أو طلب كتالوجات وعينات، يرجى استخدام نموذج التواصل أو نموذج طلب المعلومات. سيتواصل معكم فريقنا في أقرب وقت ممكن.</p>',
                    'en' => '<p>For business inquiries or to request catalogs and samples, please use the contact form or information request form. Our team will respond as soon as possible.</p>',
                    'ja' => '<p>ビジネスに関するお問い合わせ、カタログ・サンプルのご請求は、お問い合わせフォームまたは情報リクエストフォームをご利用ください。担当者より折り返しご連絡いたします。</p>',
                ],
            ],
            FixedPageSlugEnum::PRIVACY_POLICY->value => [
                'name' => ['ar' => 'سياسة الخصوصية', 'en' => 'Privacy Policy', 'ja' => 'プライバシーポリシー'],
                'sub_title' => [
                    'ar' => 'كيف نتعامل مع بياناتكم',
                    'en' => 'How we handle your data',
                    'ja' => 'お客様のデータの取り扱い',
                ],
                'description' => [
                    'ar' => '<p>Privacy Policy

                                We are committed to protecting our customers’ personal information and ensuring that our services can be used with confidence. We handle personal information in accordance with the following policy.

                                1. Collection of Personal Information
                                We may collect personal information such as names, addresses, phone numbers, and email addresses when customers make inquiries, place orders, or request materials. Information is collected only to the extent necessary for providing our services.

                                2. Purpose of Use
                                The personal information we collect is used for the following purposes:
                                ・Shipping products and providing related services
                                ・Responding to inquiries
                                ・Providing information on new products, services, and promotions
                                ・Conducting analysis and improvements to enhance our services
                                ・Complying with legal obligations

                                3. Provision of Personal Information to Third Parties
                                We do not provide personal information to third parties except in the following cases:
                                ・When the customer has given consent
                                ・When required by law
                                ・When providing information to service providers (such as delivery companies) within the necessary scope of operations

                                4. Management of Personal Information
                                We implement appropriate security measures to prevent unauthorized access, loss, damage, alteration, or leakage of personal information.

                                5. Disclosure, Correction, and Deletion of Personal Information
                                If a customer requests the disclosure, correction, or deletion of their personal information, we will respond appropriately after confirming the identity of the requester.

                                6. Use of Cookies
                                Our website may use cookies to improve convenience and analyze access. Cookies do not collect information that identifies individuals.

                                7. Revisions to the Privacy Policy
                                We may revise this policy as necessary. Any changes will take effect when the updated policy is posted on this website.

                                8. Contact Information
                                For inquiries regarding the handling of personal information, please contact us through our email.</p>',
                    'en' => '<p>Privacy Policy

                                We are committed to protecting our customers’ personal information and ensuring that our services can be used with confidence. We handle personal information in accordance with the following policy.

                                1. Collection of Personal Information
                                We may collect personal information such as names, addresses, phone numbers, and email addresses when customers make inquiries, place orders, or request materials. Information is collected only to the extent necessary for providing our services.

                                2. Purpose of Use
                                The personal information we collect is used for the following purposes:
                                ・Shipping products and providing related services
                                ・Responding to inquiries
                                ・Providing information on new products, services, and promotions
                                ・Conducting analysis and improvements to enhance our services
                                ・Complying with legal obligations

                                3. Provision of Personal Information to Third Parties
                                We do not provide personal information to third parties except in the following cases:
                                ・When the customer has given consent
                                ・When required by law
                                ・When providing information to service providers (such as delivery companies) within the necessary scope of operations

                                4. Management of Personal Information
                                We implement appropriate security measures to prevent unauthorized access, loss, damage, alteration, or leakage of personal information.

                                5. Disclosure, Correction, and Deletion of Personal Information
                                If a customer requests the disclosure, correction, or deletion of their personal information, we will respond appropriately after confirming the identity of the requester.

                                6. Use of Cookies
                                Our website may use cookies to improve convenience and analyze access. Cookies do not collect information that identifies individuals.

                                7. Revisions to the Privacy Policy
                                We may revise this policy as necessary. Any changes will take effect when the updated policy is posted on this website.

                                8. Contact Information
                                For inquiries regarding the handling of personal information, please contact us through our email.</p>',
                    'ja' => '<p>プライバシーポリシー
                                　当社は、お客様の個人情報を適切に保護し、安心してサービスをご利用いただけるよう、以下の方針に基づき個人情報の取り扱いを行います。

                                1. 個人情報の取得について
                                　当社は、お問い合わせやご注文、資料請求などの際に、お客様の氏名、住所、電話番号、メールアドレスなど、サービス提供に必要な範囲で個人情報を取得します。

                                2. 個人情報の利用目的
                                取得した個人情報は、以下の目的のために利用します。
                                ・商品の発送および関連するサービスの提供
                                ・お問い合わせへの回答
                                ・新商品・サービス・キャンペーン等のご案内
                                ・サービス向上のための分析・改善
                                ・法令に基づく対応

                                3. 個人情報の第三者提供について
                                当社は、以下の場合を除き、個人情報を第三者に提供することはありません。
                                ・お客様の同意がある場合
                                ・法令に基づく場合
                                ・業務委託先（配送業者など）に必要な範囲で提供する場合

                                4. 個人情報の管理について
                                　当社は、個人情報への不正アクセス、紛失、破損、改ざん、漏えいを防止するため、適切な安全管理措置を講じます。

                                5. 個人情報の開示・訂正・削除について
                                　お客様ご本人から、個人情報の開示・訂正・削除などのご要望があった場合、適切な方法で対応します。

                                6. クッキー（Cookie）等の利用について
                                　当社サイトでは、利便性向上やアクセス解析のためにクッキーを使用する場合があります。クッキーによって個人を特定する情報は取得しません。

                                7. プライバシーポリシーの改定について
                                　当社は、必要に応じて本ポリシーを改定することがあります。改定後の内容は当サイトに掲載した時点で効力を生じます。

                                8. お問い合わせ窓口
                                　個人情報の取り扱いに関するお問い合わせは、メールにて受け付けています。</p>',
                ],
            ],
        ];

        foreach ($pages as $slug => $data) {
            $page = FixedPage::withTrashed()->where('slug', $slug)->first();

            if ($page) {
                if ($page->trashed()) {
                    $page->restore();
                }

                foreach (['name', 'sub_title', 'description'] as $field) {
                    foreach (['ar', 'en', 'ja'] as $lang) {
                        $current = $page->getTranslation($field, $lang, false);
                        if ($current === null || $current === '') {
                            $page->setTranslation($field, $lang, $data[$field][$lang]);
                        }
                    }
                }

                if ($page->isDirty()) {
                    $page->save();
                }

                continue;
            }

            FixedPage::create([
                'slug' => $slug,
                'name' => $data['name'],
                'sub_title' => $data['sub_title'],
                'description' => $data['description'],
                'image' => null,
                'status' => GeneralStatusEnum::ACTIVE->value,
            ]);
        }
    }
}
