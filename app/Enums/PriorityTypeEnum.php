<?php

namespace App\Enums;

enum PriorityTypeEnum: int
{
    case LOW    = 1;
    case MEDIUM = 2;
    case HIGH   = 3;
    case URGENT = 4;

    public function label(): string
    {
        return match ($this) {
            self::LOW    => __('admin.low'),
            self::MEDIUM => __('admin.medium'),
            self::HIGH   => __('admin.high'),
            self::URGENT => __('admin.urgent'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::URGENT => 'danger',
            self::HIGH   => 'warning',
            self::MEDIUM => 'primary',
            self::LOW    => 'secondary',
        };
    }
}
