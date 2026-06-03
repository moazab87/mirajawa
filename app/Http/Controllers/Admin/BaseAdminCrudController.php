<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class BaseAdminCrudController extends BaseCrudRepository
{
    abstract protected function service();

    public function __construct()
    {
        parent::__construct();
        $this->setData();
    }

    public function store()
    {
        try {
            $data = app($this->storeRequest)->validated();
            $result = DB::transaction(fn () => $this->service()->store($data));

            return $result['key'] === 'success'
                ? redirect()->route("admin.{$this->folderName}.index")->with($result['key'], $result['msg'])
                : redirect()->back()->with('failed', __('dashboard.messages.failed'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $data = app($this->updateRequest)->validated();
            $model = $this->model->findOrFail($id);
            $result = DB::transaction(fn () => $this->service()->update($model, $data));

            return $result['key'] === 'success'
                ? redirect()->route("admin.{$this->folderName}.index")->with($result['key'], $result['msg'])
                : redirect()->back()->with('failed', __('dashboard.messages.failed'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $models = $this->model->orderBy('id', 'desc');

        if ($request->filled('status') && in_array('status', $this->model->getFillable())) {
            $models->where('status', $request->status);
        }

        if ($request->filled('category_id') && method_exists($this->model, 'category')) {
            $models->where('category_id', $request->category_id);
        }

        if ($request->filled('product_group_id')) {
            $models->where('product_group_id', $request->product_group_id);
        }

        if ($request->filled('search')) {
            $searchTerm = mb_strtolower($request->search, 'UTF-8');
            $models->where(function ($query) use ($searchTerm) {
                foreach ($this->model::SEARCH_ATTRIBUTES as $column) {
                    if ($this->isTranslatableColumn($column)) {
                        foreach (languages() as $lang) {
                            $query->orWhereRaw(
                                'LOWER(JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', "$.' . $lang . '"))) like ?',
                                ["%{$searchTerm}%"]
                            );
                        }
                    } else {
                        $query->orWhere($column, 'like', "%{$searchTerm}%");
                    }
                }
            });
        }

        $models = $models->paginate(20)->withQueryString();

        return view("admin.{$this->folderName}.index", array_merge(
            $this->getViewData(),
            $this->service()->indexExtraData($request) ?? [],
            compact('models')
        ));
    }

    public function create(): View
    {
        return $this->service()->create();
    }

    public function edit($id): View
    {
        return $this->service()->edit($this->model->findOrFail($id));
    }
}
