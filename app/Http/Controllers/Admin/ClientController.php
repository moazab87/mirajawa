<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Client\StoreClientRequest;
use App\Http\Requests\Admin\Client\UpdatClientsRequest;
use App\Models\Client;
use App\Services\Admin\ClientService;

class ClientController extends BaseCrudRepository
{
    public function __construct(protected ClientService $service)
    {
        parent::__construct();
        $this->setData();
    }

    public function setData()
    {
        $this->model            = new Client();
        $this->storeRequest     = StoreClientRequest::class;
        $this->updateRequest    = StoreClientRequest::class;
    }

    public function create()
    {
        return $this->service->create();
    }

    public function edit($id)
    {
        return $this->service->edit(Client::findOrFail($id));
    }
}
