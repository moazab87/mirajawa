<?php

namespace App\Http\Requests\Admin\Address;

use App\Http\Requests\Admin\Concerns\TranslatableRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class   StoreRequest extends FormRequest
{
    use TranslatableRequestRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(
            $this->translatableRules(['name' => true, 'description' => false, 'map_desc' => false]),
            [
                'address' => 'nullable|string',
                'lat'     => 'nullable|numeric',
                'lng'     => 'nullable|numeric',
                'status'  => generalStatusRule(),
            ]
        );
    }
}
