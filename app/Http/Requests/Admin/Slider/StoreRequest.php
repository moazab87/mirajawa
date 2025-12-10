<?php

namespace App\Http\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'is_active' => 'nullable|boolean',
            'media'     => 'required|file|mimes:jpeg,jpg,png,gif,webp,mp4,mov,avi,wmv,flv,webm|max:5120',
        ];
    }
}

