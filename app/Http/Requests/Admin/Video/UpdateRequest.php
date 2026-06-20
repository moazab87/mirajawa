<?php

namespace App\Http\Requests\Admin\Video;

use App\Http\Requests\Admin\Concerns\TranslatableRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use TranslatableRequestRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->translatableRules(['title' => false, 'description' => false]),
            [
                'video' => 'nullable|file|mimes:mp4,webm,mov|max:102400',
                'status' => generalStatusRule(),
                'sort_order' => 'nullable|integer|min:0',
            ]
        );
    }
}
