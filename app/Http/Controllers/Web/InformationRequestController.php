<?php

namespace App\Http\Controllers\Web;

use App\Enums\FixedPageSlugEnum;
use App\Enums\MessageStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\InformationRequestFormRequest;
use App\Models\InformationRequest;
use App\Services\Web\WebsiteContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InformationRequestController extends Controller
{
    public function __construct(protected WebsiteContentService $content)
    {
    }

    public function create(): View
    {
        return view('web.contact.request-information', [
            'page' => $this->content->fixedPage(FixedPageSlugEnum::INFORMATION),
        ]);
    }

    public function store(InformationRequestFormRequest $request): RedirectResponse
    {
        InformationRequest::create([
            ...$request->validated(),
            'status' => MessageStatusEnum::NEW,
        ]);

        return redirect()
            ->route('web.request-information.create')
            ->with('success', __('website.request_success'));
    }
}
