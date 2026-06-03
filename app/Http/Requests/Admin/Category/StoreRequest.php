<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Admin\Concerns\TranslatableRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use TranslatableRequestRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->translatableRules(['name' => true, 'description' => false]),
            [
                'color'  => 'nullable|string|max:20',
                'status' => generalStatusRule(),
            ]
        );
    }
}
