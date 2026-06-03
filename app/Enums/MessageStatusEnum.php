<?php

namespace App\Enums;

enum MessageStatusEnum: int
{
    case NEW     = 0;
    case REPLIED = 1;

    public function label(): string
    {
        return match ($this) {
            self::NEW     => __('dashboard.statuses.new'),
            self::REPLIED => __('dashboard.statuses.replied'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::NEW     => 'warning',
            self::REPLIED => 'success',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
