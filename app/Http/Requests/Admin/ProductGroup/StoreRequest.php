<?php

namespace App\Http\Requests\Admin\ProductGroup;

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
            $this->translatableRules(['name' => true]),
            [
                'category_id' => 'required|exists:categories,id',
                'status'      => generalStatusRule(),
            ]
        );
    }
}
