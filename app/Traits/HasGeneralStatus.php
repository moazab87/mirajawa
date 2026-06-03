<?php

namespace App\Traits;

use App\Enums\GeneralStatusEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasGeneralStatus
{
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', GeneralStatusEnum::ACTIVE->value);
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        if (in_array('sort_order', $this->getFillable()) || $this->getConnection()->getSchemaBuilder()->hasColumn($this->getTable(), 'sort_order')) {
            return $query->orderBy('sort_order');
        }

        return $query->orderBy('id');
    }
}
