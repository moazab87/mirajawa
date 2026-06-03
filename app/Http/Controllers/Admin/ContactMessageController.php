<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;

class ContactMessageController extends BaseMessageController
{
    public function __construct()
    {
        parent::__construct();
        $this->setData();
    }

    public function setData(): void
    {
        $this->model = new ContactMessage();
    }
}
