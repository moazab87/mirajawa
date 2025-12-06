<?php

namespace App\Enums;

enum AuthTypeEnum: int
{
    case SUPER_ADMIN = 0;
    case ADMIN       = 1;

    public static function getText(int $value): string
    {
        return match ($value) {
            self::SUPER_ADMIN->value => __('auth.super_admin'),
            self::ADMIN->value       => __('auth.admin'),
            default                  => __('auth.unknown'),
        };
    }
}
