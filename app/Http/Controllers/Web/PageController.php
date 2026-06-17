<?php

namespace App\Http\Controllers\Web;

use App\Enums\FixedPageSlugEnum;
use App\Http\Controllers\Controller;
use App\Services\Web\WebsiteContentService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(protected WebsiteContentService $content)
    {
    }

    public function about(): View
    {
        return view('web.pages.about', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::ABOUT_US),
            'companyPage' => $this->content->fixedPage(FixedPageSlugEnum::COMPANY_INFORMATION),
            'greetingsPage' => $this->content->fixedPage(FixedPageSlugEnum::GREETINGS),
            'profiles' => $this->content->profiles(),
            'informationBlocks' => $this->content->informationBlocks(),
        ]);
    }

    public function companyProfile(): View
    {
        return view('web.pages.company-profile', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::COMPANY_INFORMATION)
                ?? $this->content->fixedPage(FixedPageSlugEnum::ABOUT_US),
            'profiles' => $this->content->profiles(),
            'informationBlocks' => $this->content->informationBlocks(),
            'greetingsPage' => $this->content->fixedPage(FixedPageSlugEnum::GREETINGS),
        ]);
    }

    public function business(): View
    {
        return view('web.pages.business', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::BUSINESS),
            'informationBlocks' => $this->content->informationBlocks(),
            'categories' => $this->content->categoriesWithCounts(),
            'factoryPage' => $this->content->fixedPage(FixedPageSlugEnum::OUR_FACTORY),
        ]);
    }

    public function whyUs(): View
    {
        return view('web.pages.why-us', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::WHY_US),
            'informationBlocks' => $this->content->informationBlocks(),
            'profiles' => $this->content->profiles(),
        ]);
    }

    public function history(): View
    {
        return view('web.pages.history', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::HISTORY),
            'histories' => $this->content->histories(),
        ]);
    }

    public function branches(): View
    {
        return view('web.pages.branches', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::OUR_FACTORY),
            'branches' => $this->content->branches(),
        ]);
    }

    public function privacy(): View
    {
        return view('web.pages.privacy', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::PRIVACY_POLICY),
        ]);
    }
}
