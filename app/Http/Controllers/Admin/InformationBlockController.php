<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\InformationBlock\StoreRequest;
use App\Http\Requests\Admin\InformationBlock\UpdateRequest;
use App\Models\InformationBlock;
use App\Services\Admin\InformationBlockService;

class InformationBlockController extends BaseAdminCrudController
{
    public function __construct(protected InformationBlockService $informationBlockService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): InformationBlockService
    {
        return $this->informationBlockService;
    }


    public function setData(): void
    {
        $this->model         = new InformationBlock();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }
}
