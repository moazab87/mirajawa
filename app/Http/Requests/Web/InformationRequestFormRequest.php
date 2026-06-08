<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequestFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'postal_code' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:5000',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('website.name'),
            'email' => __('website.email'),
            'company_name' => __('website.company_name'),
            'phone' => __('website.phone'),
            'address' => __('website.address'),
            'postal_code' => __('website.postal_code'),
            'message' => __('website.message'),
        ];
    }
}
