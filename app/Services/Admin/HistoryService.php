<?php

namespace App\Services\Admin;

use App\Models\History;

class HistoryService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return History::class;
    }

    protected function activeKey(): string
    {
        return 'histories';
    }

    protected function routeKey(): string
    {
        return 'histories';
    }

    protected function singleName(): string
    {
        return 'history';
    }
}
