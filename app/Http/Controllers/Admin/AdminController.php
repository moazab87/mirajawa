<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Admins\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\Admin\AdminService;

class AdminController extends BaseCrudRepository
{
    public function __construct(protected AdminService $service)
    {
        $this->setData();
        parent::__construct();
    }

    public function setData()
    {
        $this->model            = new Admin();
        $this->storeRequest     = AdminRequest::class;
        $this->updateRequest    = UpdateAdminRequest::class;
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store()
    {
        return $this->service->store(app($this->storeRequest)->validated());
    }

    public function edit($id)
    {
        return $this->service->edit(Admin::findOrFail($id));
    }
}

