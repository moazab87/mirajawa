<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Video\StoreRequest;
use App\Http\Requests\Admin\Video\UpdateRequest;
use App\Models\Video;
use App\Services\Admin\VideoService;
use Illuminate\Http\Request;

class VideoController extends BaseAdminCrudController
{
    public function __construct(protected VideoService $videoService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): VideoService
    {
        return $this->videoService;
    }

    public function setData(): void
    {
        $this->model = new Video();
        $this->storeRequest = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }

    public function index(Request $request)
    {
        $models = $this->model->ordered();

        if ($request->filled('status') && in_array('status', $this->model->getFillable())) {
            $models->where('status', $request->status);
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
}
