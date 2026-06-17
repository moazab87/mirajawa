<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\History\StoreRequest;
use App\Http\Requests\Admin\History\UpdateRequest;
use App\Models\History;
use App\Services\Admin\HistoryService;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $models = History::query()->orderForAdmin();

        if ($request->filled('status')) {
            $models->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $searchTerm = mb_strtolower($request->search, 'UTF-8');
            $models->where(function ($query) use ($searchTerm) {
                foreach (History::SEARCH_ATTRIBUTES as $column) {
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

        return view('admin.histories.index', array_merge(
            $this->getViewData(),
            $this->service()->indexExtraData($request) ?? [],
            compact('models')
        ));
    }
}
