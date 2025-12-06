<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['nullable', 'email', Rule::unique('clients', 'email')->ignore($this->route('client'))],
            'phone'      => ['nullable', 'string', 'max:20'],
            'status'     => ['boolean'],
            'brief'      => ['nullable', 'string'],
            'drive_link' => ['nullable', 'url'],
            'account_manager_id' => ['nullable', 'exists:users,id'],
        ];
    }

}
