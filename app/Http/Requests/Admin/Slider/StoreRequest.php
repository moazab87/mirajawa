<?php

namespace App\Http\Requests\Admin\Slider;

use App\Http\Requests\Admin\Concerns\TranslatableRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use TranslatableRequestRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->translatableRules(['title' => true, 'description' => false]),
            [
                'status' => generalStatusRule(),
                'media'  => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,avi,mov,wmv|max:51200',
            ]
        );
    }
}
