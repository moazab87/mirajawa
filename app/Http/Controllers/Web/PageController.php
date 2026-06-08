<?php

namespace App\Http\Controllers\Web;

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
            'page' => $this->content->fixedPage('about-us'),
            'companyPage' => $this->content->fixedPage('company-information'),
            'greetingsPage' => $this->content->fixedPage('greetings'),
            'profiles' => $this->content->profiles(),
            'informationBlocks' => $this->content->informationBlocks(),
        ]);
    }

    public function companyProfile(): View
    {
        return view('web.pages.company-profile', [
            'page' => $this->content->fixedPage('company-information') ?? $this->content->fixedPage('about-us'),
            'profiles' => $this->content->profiles(),
            'informationBlocks' => $this->content->informationBlocks(),
            'greetingsPage' => $this->content->fixedPage('greetings'),
        ]);
    }

    public function business(): View
    {
        return view('web.pages.business', [
            'page' => $this->content->fixedPage('business'),
            'informationBlocks' => $this->content->informationBlocks(),
            'categories' => $this->content->categoriesWithCounts(),
            'factoryPage' => $this->content->fixedPage('our-factory'),
        ]);
    }

    public function whyUs(): View
    {
        return view('web.pages.why-us', [
            'page' => $this->content->fixedPage('why-us'),
            'informationBlocks' => $this->content->informationBlocks(),
            'profiles' => $this->content->profiles(),
        ]);
    }

    public function history(): View
    {
        return view('web.pages.history', [
            'page' => $this->content->fixedPage('history'),
            'histories' => $this->content->histories(),
        ]);
    }

    public function branches(): View
    {
        return view('web.pages.branches', [
            'page' => $this->content->fixedPage('our-factory'),
            'branches' => $this->content->branches(),
        ]);
    }

    public function privacy(): View
    {
        return view('web.pages.privacy', [
            'page' => $this->content->fixedPage('privacy-policy'),
        ]);
    }
}
