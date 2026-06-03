<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseCrudRepository
{

    public function __construct(protected CategoryService $service)
    {
        parent::__construct();
        $this->setData();
    }

    public function setData()
    {
        $this->model            = new Category();
        $this->storeRequest     = StoreRequest::class;
        $this->updateRequest    = StoreRequest::class;
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
            $category = $this->model->findOrFail($id);
            $result = DB::transaction(function () use ($category, $data) {
                return $this->service->update($category, $data);
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

                foreach ($this->model::SEARCH_ATTRIBUTES as $column) {
                    if ($this->isTranslatableColumn($column)) {
                        $query->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', "$.en"))) like ?', ["%{$searchTerm}%"])
                            ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', "$.ja"))) like ?', ["%{$searchTerm}%"]);
                    } else {
                        $query->orWhere($column, 'like', "%{$searchTerm}%");
                    }
                }
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
        return $this->service->edit(Category::findOrFail($id));
    }

}
