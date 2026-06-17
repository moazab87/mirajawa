<?php

namespace App\Http\Requests\Admin\History;

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
            [
                'year' => ['required', 'integer', 'min:1900', 'max:2100'],
            ],
            $this->translatableRules(['name' => true, 'description' => false]),
            ['status' => generalStatusRule()]
        );
    }

    public function attributes(): array
    {
        return [
            'year' => __('dashboard.year'),
        ];
    }
}
