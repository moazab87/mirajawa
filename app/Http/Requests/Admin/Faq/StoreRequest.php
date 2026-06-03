<?php

namespace App\Http\Requests\Admin\Faq;

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
            $this->translatableRules(['question' => true, 'answer' => false]),
            ['status' => generalStatusRule()]
        );
    }
}
