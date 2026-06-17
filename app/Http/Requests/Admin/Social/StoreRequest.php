<?php

namespace App\Http\Requests\Admin\Social;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'url'       => 'required|url|max:255',
            'icon'      => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\-\_\s]+$/'],
            'is_active' => 'nullable|boolean',
        ];
    }
}
