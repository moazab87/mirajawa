<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class EnumHelper
{
    public static function all(string $enumClass): string
    {
        return implode(',', array_column($enumClass::cases(), 'value'));
    }

    public static function toArray(string $enumClass): array
    {
        return array_map(fn($case) => [
            'name'  => $case->name,
            'value' => $case->value
        ], $enumClass::cases());
    }

    public static function randVal(string $enumClass)
    {
        $randomStatus = Arr::random($enumClass::cases());
        //        echo $randomStatus->name;   // e.g., "APPROVED"
        return $randomStatus->value;
    }


    public static function nameFor(string $enumClass, int|string $value): ?string
    {
        foreach ($enumClass::cases() as $case) {
            if ($case->value === $value) {
                return ucfirst(strtolower(str_replace('_', ' ', $case->name)));
            }
        }
        return null;
    }

    public static function forApi(string $enumClass): array
    {
        return array_map(fn($case) => [
            'id'   => $case->value,
            'name' => __(strtolower($case->name))
        ], $enumClass::cases());
    }

    public static function forWeb(string $enumClass): array
    {
        return array_map(fn($case) => [
            'id'   => $case->value,
            'name' => __('admin.' . strtolower($case->name))
        ], $enumClass::cases());
    }

    public static function slug(string $enumClass, int|string $value): string
    {
        foreach ($enumClass::cases() as $case) {
            if ($case->value === $value) {
                return strtolower($case->name);
            }
        }
        return '';
    }

    public static function toResource(string $enumClass, int|string|null $constValue, string $file = 'enums', string $prefix = ''): array
    {
        foreach ($enumClass::cases() as $case) {
            if ($case->value === $constValue) {
                $arrName = lcfirst(class_basename($enumClass));
                $name    = strtolower($case->name);

                return [
                    'key'          => $constValue,
                    'name'         => $name,
                    'title'        => __("$file.$arrName.$prefix$name"),
                    'details_text' => __("$file.$arrName.status_details_$name"),
                ];
            }
        }

        return [
            'key'          => $constValue,
            'name'         => '',
            'title'        => '',
            'details_text' => '',
        ];
    }
}
