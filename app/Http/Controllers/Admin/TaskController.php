<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Task\StoreRequest;
use App\Models\Task;
use App\Services\Admin\TaskService;

class TaskController extends BaseCrudRepository
{

    public function __construct(protected TaskService $service)
    {
        parent::__construct($service);
        $this->setData();
    }


    public function setData()
    {
        $this->model            = new Task();
        $this->storeRequest     = StoreRequest::class;
        $this->updateRequest    = StoreRequest::class;
    }

    public function create()
    {
        return $this->service->create();
    }

    public function edit($id)
    {
        return $this->service->edit(Task::findOrFail($id));
    }
}
