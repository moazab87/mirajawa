<?php

namespace App\Base\Repositories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseCrudRepository extends Controller
{
    protected   $model;
    protected   $storeRequest;
    protected   $updateRequest;
    protected   $fileName;
    protected   $folderName;

    public function __construct()
    {
        $this->setData();
        $this->fileName     = $this->model::FILE_KEY ?? null;
        $this->folderName   = $this->model::FOLDER_NAME ?? null;
    }

    abstract protected function setData();

    public function index(Request $request)
    {
        $models = $this->model
            ->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $models = $models->where(function ($query) use ($request) {
                $searchTerm = mb_strtolower($request->search, 'UTF-8');

                foreach ($this->model::SEARCH_ATTRIBUTES as $column) {
                    if ($this->isTranslatableColumn($column)) {
                        $query->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', "$.en"))) like ?', ["%{$searchTerm}%"])
                            ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', "$.ar"))) like ?', ["%{$searchTerm}%"]);
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

    public function create()
    {
        return view("admin.{$this->folderName}.create", array_merge(
            $this->getViewData(),
            [
                'subTitle'   => __("route.{$this->folderName}.create"),
                'storeRoute' => route("admin.{$this->folderName}.store"),
            ]
        ));
    }

    public function store()
    {
        $data = $this->model->create(app($this->storeRequest)->validated());

        return $data
            ? redirect()->route("admin.{$this->folderName}.index")->with('success', trans('admin.successMessageText'))
            : redirect()->back()->with('failed', trans('admin.faildMessageText'));
    }

    public function edit($id)
    {
        $model = $this->model->findOrFail($id);

        return view("admin.{$this->folderName}.edit", array_merge(
            $this->getViewData(),
            [
                'subTitle'    => __("route.{$this->folderName}.edit"),
                'updateRoute' => route("admin.{$this->folderName}.update", $id),
            ],
            compact('model')
        ));
    }

    public function update($id)
    {
        $data = $this->model->findOrFail($id)->update(app($this->updateRequest)->validated());

        return $data
            ? redirect()->route("admin.{$this->folderName}.index")->with('success', trans('admin.editSuccessMessageText'))
            : redirect()->back()->with('failed', trans('admin.faildMessageText'));
    }

    public function destroy($id)
    {
        $data = $this->model->findOrFail($id);
        $image = $data->getRawOriginal($this->fileName);

        if ($data->delete() && $image) {
            deleteImage(public_path("uploads/{$this->folderName}/{$image}"));
        }

        return response()->json(['id' => $id, 'success' => true]);
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

    // Helper methods
    protected function getViewData(): array
    {
        return [
            'active'       => $this->folderName,
            'title'        => trans("route.{$this->folderName}.index"),
            'singleName'   => $this->model::SINGLE_NAME,
            'route'        => route("admin.{$this->folderName}.index"),
            'createRoute'  => route("admin.{$this->folderName}.create"),
            'editRoute'    => "admin.{$this->folderName}.edit",
            'deleteRoute'  => "admin.{$this->folderName}.destroy",
            'showRoute'    => "admin.{$this->folderName}.show",
        ];
    }

    protected function isTranslatableColumn(string $column): bool
    {
        return isset($this->model->translatable)
            && in_array($column, $this->model->translatable);
    }
}
