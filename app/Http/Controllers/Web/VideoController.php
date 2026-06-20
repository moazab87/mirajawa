<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\WebsiteContentService;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function __construct(protected WebsiteContentService $content)
    {
    }

    public function index(): View
    {
        return view('web.pages.videos', [
            'videos' => $this->content->videos(),
        ]);
    }
}
