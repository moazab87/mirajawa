<?php

namespace App\Http\Requests\Admin\Project;

use App\Enums\StatusModelsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'team_id'     => ['required', 'exists:teams,id'],
            'client_id'   => ['nullable', 'exists:clients,id'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', Rule::in(array_column(StatusModelsEnum::cases(), 'value'))],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'created_by'  => ['nullable', 'exists:admins,id'],
        ];
    }

    public function prepareForValidation(): void
    {
        if (!$this->has('created_by')) {
            $this->merge([
                'created_by' => auth('admin')->id(),
            ]);
        }
    }

}
