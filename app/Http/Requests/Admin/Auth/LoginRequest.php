<?php

namespace App\Http\Requests\Admin\Auth;

use App\Base\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiRequest
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
            'email'         => 'required|email',
            'password'      => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->email && $this->password) {
                $credentials = [
                    'email'         => $this->email,
                    'password'      => $this->password,
                ];

                if (!auth()->guard('admin')->attempt($credentials)) {
                    $validator->errors()->add('email', __('admin.InvalidEmailOrPassword'));
                }
            }
        });
    }
}
