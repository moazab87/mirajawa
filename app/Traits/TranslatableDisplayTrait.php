<?php

namespace App\Traits;

trait TranslatableDisplayTrait
{
    public function getDisplayTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        $fallbackOrder = array_unique([$locale, 'ar', 'en', 'ja']);

        foreach ($fallbackOrder as $lang) {
            $value = $this->getTranslation($field, $lang, false);
            if (filled($value)) {
                return $value;
            }
        }

        return null;
    }
}
