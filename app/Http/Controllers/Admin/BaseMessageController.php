<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Enums\MessageStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class BaseMessageController extends BaseCrudRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setData();
    }

    public function index(Request $request)
    {
        $models = $this->model->orderBy('id', 'desc');

        if ($request->filled('status')) {
            $models->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $searchTerm = mb_strtolower($request->search, 'UTF-8');
            $models->where(function ($query) use ($searchTerm) {
                foreach ($this->model::SEARCH_ATTRIBUTES as $column) {
                    $query->orWhere($column, 'like', "%{$searchTerm}%");
                }
            });
        }

        $models = $models->paginate(20)->withQueryString();

        return view("admin.{$this->folderName}.index", array_merge(
            $this->getViewData(),
            [
                'statuses' => MessageStatusEnum::cases(),
                'createRoute' => null,
            ],
            compact('models')
        ));
    }

    public function show($id)
    {
        $model = $this->model->findOrFail($id);

        return view("admin.{$this->folderName}.show", array_merge(
            $this->getViewData(),
            ['subTitle' => dashboard_trans($this->folderName, 'show')],
            compact('model')
        ));
    }

    public function markReplied($id)
    {
        $model = $this->model->findOrFail($id);
        $model->update(['status' => MessageStatusEnum::REPLIED->value]);

        return redirect()
            ->route("admin.{$this->folderName}.show", $id)
            ->with('success', dashboard_trans($this->folderName, 'status_updated_successfully'));
    }

    public function create()
    {
        abort(404);
    }

    public function store()
    {
        abort(404);
    }

    public function edit($id)
    {
        abort(404);
    }

    public function update($id)
    {
        abort(404);
    }
}
