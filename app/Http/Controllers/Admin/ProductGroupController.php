<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProductGroup\StoreRequest;
use App\Http\Requests\Admin\ProductGroup\UpdateRequest;
use App\Models\ProductGroup;
use App\Services\Admin\ProductGroupService;

class ProductGroupController extends BaseAdminCrudController
{
    public function __construct(protected ProductGroupService $productGroupService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): ProductGroupService
    {
        return $this->productGroupService;
    }

    public function setData(): void
    {
        $this->model         = new ProductGroup();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }
}
