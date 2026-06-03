<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\History\StoreRequest;
use App\Http\Requests\Admin\History\UpdateRequest;
use App\Models\History;
use App\Services\Admin\HistoryService;

class HistoryController extends BaseAdminCrudController
{
    public function __construct(protected HistoryService $historyService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): HistoryService
    {
        return $this->historyService;
    }


    public function setData(): void
    {
        $this->model         = new History();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }
}
