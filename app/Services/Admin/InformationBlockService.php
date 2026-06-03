<?php

namespace App\Services\Admin;

use App\Models\InformationBlock;

class InformationBlockService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return InformationBlock::class;
    }

    protected function activeKey(): string
    {
        return 'informationBlocks';
    }

    protected function routeKey(): string
    {
        return 'informationBlocks';
    }

    protected function singleName(): string
    {
        return 'informationBlock';
    }
}
