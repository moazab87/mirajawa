<?php

namespace App\Enums;

enum GeneralStatusEnum: int
{
    case INACTIVE = 0;
    case ACTIVE   = 1;

    public function label(): string
    {
        return match ($this) {
            self::INACTIVE => __('dashboard.statuses.inactive'),
            self::ACTIVE   => __('dashboard.statuses.active'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::INACTIVE => 'danger',
            self::ACTIVE   => 'success',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
