<?php

namespace App\Services\Admin;

use App\Models\Faq;

class FaqService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Faq::class;
    }

    protected function activeKey(): string
    {
        return 'faqs';
    }

    protected function routeKey(): string
    {
        return 'faqs';
    }

    protected function singleName(): string
    {
        return 'faq';
    }
}
