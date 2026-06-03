<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ContactInformation\StoreRequest;
use App\Http\Requests\Admin\ContactInformation\UpdateRequest;
use App\Models\ContactInformation;
use App\Services\Admin\ContactInformationService;

class ContactInformationController extends BaseAdminCrudController
{
    public function __construct(protected ContactInformationService $contactInformationService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): ContactInformationService
    {
        return $this->contactInformationService;
    }


    public function setData(): void
    {
        $this->model         = new ContactInformation();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }
}
