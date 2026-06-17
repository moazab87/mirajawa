<?php

namespace App\Http\Controllers\Web;

use App\Enums\FixedPageSlugEnum;
use App\Http\Controllers\Controller;
use App\Services\Web\WebsiteContentService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(protected WebsiteContentService $content)
    {
    }

    public function index(): View
    {
        return view('web.home', [
            'sliders' => $this->content->sliders(),
            'welcomePage' => $this->content->fixedPage(FixedPageSlugEnum::WELCOME),
            'aboutPage' => $this->content->fixedPage(FixedPageSlugEnum::ABOUT_US),
            'whyPage' => $this->content->fixedPage(FixedPageSlugEnum::WHY_US),
            'businessPage' => $this->content->fixedPage(FixedPageSlugEnum::BUSINESS),
            'categories' => $this->content->categoriesWithCounts(),
            'featuredProducts' => $this->content->featuredProducts(6),
            'profiles' => $this->content->profiles()->take(3),
            'informationBlocks' => $this->content->informationBlocks(),
            'histories' => $this->content->histories()->take(4),
            'branches' => $this->content->branches()->take(3),
        ]);
    }
}
