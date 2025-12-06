<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|max:191',
            'guard_name'  => 'required|max:191',
            'permissions' => 'array',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'guard_name'          => 'admin',
        ]);
    }
}
