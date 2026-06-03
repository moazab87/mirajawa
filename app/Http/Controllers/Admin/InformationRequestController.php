<?php

namespace App\Http\Controllers\Admin;

use App\Models\InformationRequest;

class InformationRequestController extends BaseMessageController
{
    public function __construct()
    {
        parent::__construct();
        $this->setData();
    }

    public function setData(): void
    {
        $this->model = new InformationRequest();
    }
}
