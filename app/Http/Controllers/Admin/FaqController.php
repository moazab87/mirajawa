<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Faq\StoreRequest;
use App\Http\Requests\Admin\Faq\UpdateRequest;
use App\Models\Faq;
use App\Services\Admin\FaqService;

class FaqController extends BaseAdminCrudController
{
    public function __construct(protected FaqService $faqService)
    {
        parent::__construct();
        $this->setData();
    }

    protected function service(): FaqService
    {
        return $this->faqService;
    }


    public function setData(): void
    {
        $this->model         = new Faq();
        $this->storeRequest  = StoreRequest::class;
        $this->updateRequest = UpdateRequest::class;
    }
}
