<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Product;
use App\Services\Admin\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseCrudRepository
{

    public function __construct(protected ProductService $service)
    {
        parent::__construct($service);
        $this->setData();
    }

    public function setData()
    {
        $this->model            = new Product();
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
            $product = $this->model->findOrFail($id);
            $result = DB::transaction(function () use ($product, $data) {
                return $this->service->update($product, $data);
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
        $models = $this->model->with('category')->orderBy('id', 'desc');

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
        return $this->service->edit(Product::findOrFail($id));
    }

    public function show($id)
    {
        $model = $this->model->with('attachments', 'category')->findOrFail($id);

        return view("admin.{$this->folderName}.show", array_merge(
            $this->getViewData(),
            ['subTitle' => __("route.{$this->folderName}.show")],
            compact('model')
        ));
    }

    /**
     * Delete a product attachment
     */
    public function deleteAttachment($product, $attachment)
    {
        try {
            $productModel = $this->model->findOrFail($product);
            $attachmentModel = \App\Models\Attachment::where('id', $attachment)
                ->where('attachable_id', $product)
                ->where('attachable_type', Product::class)
                ->firstOrFail();

            // Delete the file from storage
            $filePath = storage_path('app/public/attachments/products/' . $attachmentModel->file_name);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the attachment record
            $attachmentModel->delete();

            return response()->json(['id' => $attachment, 'success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}

