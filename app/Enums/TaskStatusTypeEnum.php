<?php

namespace App\Enums;

enum TaskStatusTypeEnum: int
{
    case TODO        = 0;
    case IN_PROGRESS = 1;
    case DONE        = 2;


    public function label(): string
    {
        // Or use lang: __('tasks.status.'.$this->value)
        return match ($this) {
            self::TODO        => __('admin.todo'),
            self::IN_PROGRESS => __('admin.in_progress'),
            self::DONE        => __('admin.done'),
            default           => __('admin.unknown'),
        };
    }

    public function color(): string
    {
        // Just the Bootstrap color keyword
        return match ($this) {
            self::DONE        => 'success',
            self::IN_PROGRESS => 'info',
            self::TODO        => 'warning',
        };
    }
}
