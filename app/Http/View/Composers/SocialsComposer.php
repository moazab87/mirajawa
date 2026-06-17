<?php

namespace App\Http\View\Composers;

use App\Models\Social;
use Illuminate\View\View;

class SocialsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('socials', Social::query()
            ->where('is_active', true)
            ->whereNotNull('url')
            ->where('url', '!=', '')
            ->orderBy('id')
            ->get());
    }
}

