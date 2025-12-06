<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Role\RoleStoreRequest;
use App\Services\Admin\RoleService;
use Spatie\Permission\Models\Role;

class RoleController extends BaseCrudRepository
{
    public function __construct(protected RoleService $service)
    {
        $this->setData();
        parent::__construct();
    }

    public function setData()
    {
        $this->model            = new Role();
        $this->storeRequest     = RoleStoreRequest::class;
        $this->updateRequest    = RoleStoreRequest::class;
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
        return $this->service->edit(Role::findOrFail($id));
    }

    public function update($id)
    {
        return $this->service->update(
            Role::findOrFail($id),
            app($this->updateRequest)->validated()
        );
    }
}
