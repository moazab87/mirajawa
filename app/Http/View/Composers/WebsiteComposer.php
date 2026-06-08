<?php

namespace App\Http\View\Composers;

use App\Services\Web\WebsiteContentService;
use Illuminate\View\View;

class WebsiteComposer
{
    public function __construct(protected WebsiteContentService $content)
    {
    }

    public function compose(View $view): void
    {
        $view->with([
            'navCategories' => $this->content->categoriesWithCounts(),
            'sitePhone' => getSettingValue('phone'),
            'siteSinceYear' => getSettingValue('since_year'),
        ]);
    }
}
