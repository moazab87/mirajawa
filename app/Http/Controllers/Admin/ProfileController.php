<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Profile\StoreRequest;
use App\Http\Requests\Admin\Profile\UpdateRequest;
use App\Models\Profile;
use App\Services\Admin\ProfileService;

class ProfileController extends BaseAdminCrudController
{
    public function __construct(protected ProfileService $profileService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): ProfileService
    {
        return $this->profileService;
    }


    public function setData(): void
    {
        $this->model         = new Profile();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }
}
