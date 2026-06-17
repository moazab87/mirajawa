<?php

namespace App\Enums;

enum FixedPageSlugEnum: string
{
    case PRIVACY_POLICY = 'privacy-policy';
    case OUR_FACTORY = 'our-factory';
    case WELCOME = 'welcome';
    case HISTORY = 'history';
    case WHY_US = 'why-us';
    case PRODUCTS = 'products';
    case COMPANY_INFORMATION = 'company-information';
    case ABOUT_US = 'about-us';
    case INFORMATION = 'information';
    case BUSINESS = 'business';
    case GREETINGS = 'greetings';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function isSystemSlug(?string $slug): bool
    {
        return $slug !== null && in_array($slug, self::values(), true);
    }
}
