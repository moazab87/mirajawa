<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Social\StoreRequest;
use App\Http\Requests\Admin\Social\UpdateRequest;
use App\Models\Social;
use App\Services\Admin\SocialService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class SocialController extends BaseCrudRepository
{

    public function __construct(protected SocialService $service)
    {
        parent::__construct();
        $this->setData();
    }

    public function setData()
    {
        $this->model            = new Social();
        $this->storeRequest     = StoreRequest::class;
        $this->updateRequest    = UpdateRequest::class;
    }

    public function store()
    {
        try {
            $data = app($this->storeRequest)->validated();
            $result = DB::transaction(function () use ($data) {
                return $this->service->store($data);
            });

            return $result['key'] == 'success'
                ? redirect()->route("admin.{$this->folderName}.index")->with($result['key'], $result['msg'])
                : redirect()->back()->with('failed', trans('admin.failedMessageText'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = app($this->updateRequest)->validated();
            $social = $this->model->findOrFail($id);
            $result = DB::transaction(function () use ($social, $data) {
                return $this->service->update($social, $data);
            });

            return $result['key'] == 'success'
                ? redirect()->route("admin.{$this->folderName}.index")->with($result['key'], $result['msg'])
                : redirect()->back()->with('failed', trans('admin.failedMessageText'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function index(\Illuminate\Http\Request $request)
    {
        $models = $this->model->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $models = $models->where(function ($query) use ($request) {
                $searchTerm = mb_strtolower($request->search, 'UTF-8');
                $query->orWhere('name', 'like', "%{$searchTerm}%")
                      ->orWhere('url', 'like', "%{$searchTerm}%");
            });
        }

        $models = $models->paginate(20);

        return view("admin.{$this->folderName}.index", array_merge(
            $this->getViewData(),
            compact('models')
        ));
    }

    public function create(): View
    {
        return $this->service->create();
    }

    public function edit($id): View
    {
        return $this->service->edit(Social::findOrFail($id));
    }

    public function show($id)
    {
        $model = $this->model->findOrFail($id);

        return view("admin.{$this->folderName}.show", array_merge(
            $this->getViewData(),
            ['subTitle' => __("route.{$this->folderName}.show")],
            compact('model')
        ));
    }
}

