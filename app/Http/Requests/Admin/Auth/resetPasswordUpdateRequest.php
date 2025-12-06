<?php

namespace App\Http\Requests\Admin\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class resetPasswordUpdateRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'exists:admins,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];
    }


    public function messages(): array
    {
        return [
            'email.required'    => 'Email is required!',
            'email.email'       => 'Email is invalid!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password must be at least 8 characters!',
            'password.confirmed' => 'Password and Confirm Password must be the same!',
        ];
    }

    public function withValidator($validator)
    {

        $validator->after(function ($validator) {
            $admin = Admin::where('email', $this->email)->first();
            if ($admin) {
                if ($admin->type != 'super_admin') {
                    $validator->errors()->add('email', 'Invalid Email');
                }

                if($admin->updateable()->where('type', 'password')->first()->code == ''){
                    $validator->errors()->add('email', 'Invalid Email');
                }
            }

        });
    }
}
