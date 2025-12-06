<?php

namespace App\Base\Repositories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

abstract class BaseStoreCrudRepository extends Controller
{
    protected   $model;
    protected   $storeRequest;
    protected   $updateRequest;
    private     $fileName;
    private     $folderName;

    public function __construct()
    {
        $this->setData();
        $this->fileName     = $this->model::FILE_KEY;
        $this->folderName   = $this->model::FOLDER_NAME;
    }

    abstract protected function setData();

    public function index(Request $request)
    {
        $models = $this->model
            ->where('store_id', auth()->guard('store')->id())
            ->orderBy('id', 'desc');

        if ($request->has('search') && $request->search != '') {
            // search in specific columns only in the model using the SEARCH_ATTRIBUTES constant
            $models = $models->where(function ($query) use ($request) {
                foreach ($this->model::SEARCH_ATTRIBUTES as $column) {
                    // check if the column is translatable or not to search in the right way
                    if (in_array($column, $this->model->translatable)) {
                        $query->orWhereRaw('JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', "$.en")) like ?', ['%' . $request->search . '%'])
                            ->orWhereRaw('JSON_UNQUOTE(JSON_EXTRACT(' . $column . ', "$.ar")) like ?', ['%' . $request->search . '%']);
                    } else {
                        $query->orWhere($column, 'like', '%' . $request->search . '%');
                    }
                }
            });
        }


        $models = $models->paginate(20);

        return view("store.$this->folderName.index", [
            'active'        => $this->folderName,
            'title'         => trans("admin.$this->folderName.index"),
            'singleName'    => $this->model::SINGLE_NAME,
            'route'         => route("store.$this->folderName.index"),
            'createRoute'   => route("store.$this->folderName.create"),
            'editRoute'     => "store.$this->folderName.edit",
            'deleteRoute'   => "store.$this->folderName.destroy",
            'showRoute'     => "store.$this->folderName.show",
        ], compact('models'));
    }

    public function create()
    {
        return view("store.$this->folderName.create", [
            'active'        => $this->folderName,
            'title'         => __("store.$this->folderName.index"),
            'subTitle'      => __("store.$this->folderName.create"),
            'singleName'    => $this->model::SINGLE_NAME,
            'route'         => route("store.$this->folderName.index"),
            'storeRoute'    => route("store.$this->folderName.store"),
        ]);
    }

    public function store()
    {
        $data = $this->model->create(app($this->storeRequest)->validated());

        if($data){
            return redirect()->route("$this->folderName.index")
                ->with('success', trans('common.successMessageText'));
        }
        else{
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }

    public function edit($id)
    {
        $model = $this->model->findOrFail($id);
        return view("store.$this->folderName.edit" , [
            'active'        => $this->folderName,
            'title'         => __("store.$this->folderName.index"),
            'subTitle'      => __("store.$this->folderName.edit"),
            'singleName'    => $this->model::SINGLE_NAME,
            'route'         => route("$this->folderName.index"),
            'updateRoute'   => route("$this->folderName.update", $id),
        ], compact('model'));
    }


    public function update($id)
    {
        $data = $this->model->findOrFail($id)->update(app($this->updateRequest)->all());
        if($data){
            return redirect()->route("$this->folderName.index")
                ->with('success', trans('common.successMessageText'));
        }
        else{
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }

    public function destroy($id)
    {
        $data = $this->model->findOrFail($id);

        $image = $data->getRawOriginal($this->fileName);

        if($data->delete()){
            if($image != null){
                delete_image(public_path('uploads/' . $this->folderName . '/' . $image));
            }
            return response()->json(['id' => $id]);
        }
        return response()->json(['id' => $id]);
    }

    public function show($id)
    {
        $model = $this->model->findOrFail($id);
        return view("store.$this->folderName.show", [
            'active'        => $this->folderName,
            'title'         => trans("admin.$this->folderName.index"),
            'subTitle'      => __("admin.$this->folderName.show"),
            'singleName'    => $this->model::SINGLE_NAME,
            'route'         => route("store.$this->folderName.index"),

        ], compact('model'));
    }
}
