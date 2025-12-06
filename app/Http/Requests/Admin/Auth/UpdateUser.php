<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        // get the user id from the route model binding
        $user= $this->route('user');
        return [
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'phone'             => 'required|numeric|unique:users,phone,' . $user->id . ',id,deleted_at,NULL|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,14',
            'email'             => 'required|string|email|max:255|unique:users,email,' . $user->id . ',id,deleted_at,NULL',
            'lang'              => 'required|in:ar,en',
            'password'          => 'nullable|string|min:8',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'phone' => fixPhone($this->phone),
        ]);
    }

}
