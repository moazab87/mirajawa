<?php

namespace App\Http\Controllers\Web;

use App\Enums\MessageStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactMessageRequest;
use App\Models\ContactMessage;
use App\Services\Web\WebsiteContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(protected WebsiteContentService $content)
    {
    }

    public function index(): View
    {
        return view('web.contact.index', [
            'page' => $this->content->fixedPage('information'),
            'contactInformation' => $this->content->contactInformation(),
            'addresses' => $this->content->addresses(),
            'branches' => $this->content->branches(),
            'faqs' => $this->content->faqs(),
        ]);
    }

    public function store(ContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create([
            ...$request->validated(),
            'status' => MessageStatusEnum::NEW,
        ]);

        return redirect()
            ->route('web.contact.index')
            ->with('success', __('website.contact_success'));
    }
}
