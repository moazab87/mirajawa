<?php

namespace App\Http\Requests\Admin\ContactInformation;

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
            $this->translatableRules(['name' => true, 'description' => false]),
            [
                'phone'  => 'nullable|string|max:30',
                'status' => generalStatusRule(),
                'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            ]
        );
    }
}
