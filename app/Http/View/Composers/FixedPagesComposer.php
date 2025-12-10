<?php

namespace App\Http\View\Composers;

use App\Models\FixedPage;
use Illuminate\View\View;

class FixedPagesComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('fixedPages', FixedPage::all());
    }
}

