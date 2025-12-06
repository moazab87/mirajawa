<?php

namespace App\Http\Requests\Admin\Notification;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
        if($this->type == "notify"){
            return [
                'title_ar'  => 'required|string',
                'title_en'  => 'required|string',
                'body_ar'   =>  'required|string',
                'body_en'   =>  'required|string',
                'user_type' => 'required|string',
            ];
        }

        return [
            'title'    => 'required|string',
            'body'     => 'required|string',
            'user_type' => 'required|string',
        ];
    }
}
