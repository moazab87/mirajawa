<?php

namespace App\Http\Requests\Admin\FixedPage;

use App\Http\Requests\Admin\Concerns\TranslatableRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use TranslatableRequestRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->translatableRules([
                'name' => true,
                'sub_title' => false,
                'description' => false,
            ]),
            [
                'status' => generalStatusRule(),
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            ]
        );
    }

    public function validationData(): array
    {
        return collect(parent::validationData())->except('slug')->all();
    }
}
