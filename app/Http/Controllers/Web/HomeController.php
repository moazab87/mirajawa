<?php

namespace App\Http\Controllers\Web;

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
            'welcomePage' => $this->content->fixedPage('welcome'),
            'aboutPage' => $this->content->fixedPage('about-us'),
            'whyPage' => $this->content->fixedPage('why-us'),
            'businessPage' => $this->content->fixedPage('business'),
            'categories' => $this->content->categoriesWithCounts(),
            'featuredProducts' => $this->content->featuredProducts(6),
            'profiles' => $this->content->profiles()->take(3),
            'informationBlocks' => $this->content->informationBlocks(),
            'histories' => $this->content->histories()->take(4),
            'branches' => $this->content->branches()->take(3),
        ]);
    }
}
