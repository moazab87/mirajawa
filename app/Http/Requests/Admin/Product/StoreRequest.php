<?php

namespace App\Http\Requests\Admin\Product;

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
            'name.*'        => 'required',
            'description.*' => 'nullable',
            'link'          => 'nullable|url|max:255',
            'category_id'  => 'required|exists:categories,id',
            'images.*'     => 'nullable|file|mimes:jpeg,jpg,png,gif,webp|max:10240', // 10MB max for images
            'videos.*'     => 'nullable|file|mimes:mp4,mov,avi,wmv,flv,webm|max:51200', // 50MB max for videos
        ];
    }
}

