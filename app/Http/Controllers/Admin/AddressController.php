<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Address\StoreRequest;
use App\Http\Requests\Admin\Address\UpdateRequest;
use App\Models\Address;
use App\Services\Admin\AddressService;

class AddressController extends BaseAdminCrudController
{
    public function __construct(protected AddressService $addressService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): AddressService
    {
        return $this->addressService;
    }


    public function setData(): void
    {
        $this->model         = new Address();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }
}
