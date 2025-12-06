<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Project\StoreRequest;
use App\Models\Client;
use App\Models\Project;
use App\Services\Admin\ProjectService;
use Illuminate\Http\JsonResponse;

class ProjectController extends BaseCrudRepository
{

    public function __construct(protected ProjectService $service)
    {
        parent::__construct($service);
        $this->setData();
    }


    public function setData()
    {
        $this->model            = new Project();
        $this->storeRequest     = StoreRequest::class;
        $this->updateRequest    = StoreRequest::class;
    }

    public function create()
    {
        return $this->service->create();
    }

    public function edit($id)
    {
        return $this->service->edit(Project::findOrFail($id));
    }

    public function getProjectsByClient(Client $client): JsonResponse
    {
        $locale = app()->getLocale();

        $projects = $client->projects()
            ->toBase()
            ->select('id')
            ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$locale\"')) as name")
            ->orderBy('name')
            ->get();

        return response()->json($projects);
    }
}
