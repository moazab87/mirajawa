<?php

namespace App\Enums;

enum StatusModelsEnum: int
{
    case INACTIVE = 0;
    case ACTIVE   = 1;
    case ARCHIVED = 2;


    public function label(): string
    {
        return match ($this) {
            self::INACTIVE => __('admin.inactive'),
            self::ACTIVE   => __('admin.active'),
            self::ARCHIVED => __('admin.archived'),
            default        => __('admin.unknown'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ARCHIVED => 'secondary',
            self::INACTIVE => 'danger',
            self::ACTIVE   => 'success',
        };
    }
}
