<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FixedPageSlugEnum;
use App\Http\Requests\Admin\FixedPage\UpdateRequest;
use App\Models\FixedPage;
use App\Services\Admin\FixedPageService;
use Illuminate\Http\Request;

class FixedPageController extends BaseAdminCrudController
{
    public function __construct(protected FixedPageService $fixedPageService)
    {
        parent::__construct();
    }

    protected function service(): FixedPageService
    {
        return $this->fixedPageService;
    }

    public function setData(): void
    {
        $this->model = new FixedPage();
        $this->updateRequest = UpdateRequest::class;
    }

    public function index(Request $request)
    {
        $models = $this->model->query();
        $slugOrder = FixedPageSlugEnum::values();

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

        $models = $models
            ->orderByRaw('FIELD(slug, ' . implode(',', array_fill(0, count($slugOrder), '?')) . ')', $slugOrder)
            ->paginate(20)
            ->withQueryString();

        return view("admin.{$this->folderName}.index", array_merge(
            $this->getViewData(),
            compact('models')
        ));
    }
}
