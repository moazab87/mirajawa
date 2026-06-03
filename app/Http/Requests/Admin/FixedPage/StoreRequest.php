<?php

namespace App\Http\Requests\Admin\FixedPage;

use App\Http\Requests\Admin\Concerns\TranslatableRequestRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    use TranslatableRequestRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pageId = $this->route('fixedPage') ?? $this->route('fixed_page');

        return array_merge(
            $this->translatableRules([
                'name'        => true,
                'sub_title'   => false,
                'description' => false,
            ]),
            [
                'slug'   => [
                    'nullable',
                    'string',
                    'max:255',
                    Rule::unique('fixed_pages', 'slug')->ignore($pageId),
                ],
                'status' => generalStatusRule(),
                'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            ]
        );
    }
}
