<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Branch\StoreRequest;
use App\Http\Requests\Admin\Branch\UpdateRequest;
use App\Models\Branch;
use App\Models\BranchImage;
use App\Services\Admin\BranchService;
use Illuminate\Support\Facades\DB;

class BranchController extends BaseAdminCrudController
{
    public function __construct(protected BranchService $branchService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): BranchService
    {
        return $this->branchService;
    }


    public function setData(): void
    {
        $this->model         = new Branch();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }

    public function destroyImage(Branch $branch, BranchImage $image)
    {
        if ($image->branch_id !== $branch->id) {
            abort(404);
        }

        DB::transaction(fn () => $this->branchService->deleteImage($image));

        return back()->with('success', __('dashboard.branches.deleted_successfully'));
    }
}
