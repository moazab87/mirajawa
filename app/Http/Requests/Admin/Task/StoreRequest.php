<?php

namespace App\Http\Requests\Admin\Task;

use App\Enums\PriorityTypeEnum;
use App\Enums\TaskStatusTypeEnum;
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
            'title.ar'        => ['required', 'string', 'max:255'],
            'description.ar'  => ['nullable', 'string'],
            'client_id'       => ['nullable', 'exists:clients,id'],
            'project_id'      => ['required', 'exists:projects,id'],
            'parent_id'       => ['nullable', 'exists:tasks,id'],
            'assignee_id'     => ['nullable', 'exists:users,id'],
            'reporter_id'     => ['nullable', 'exists:users,id'],
            'status'          => ['required', Rule::in(array_column(TaskStatusTypeEnum::cases(), 'value'))],
            'priority'        => ['required', Rule::in(array_column(PriorityTypeEnum::cases(), 'value'))],
            'start_date'      => ['nullable', 'date'],
            'due_date'        => ['nullable', 'date', 'after_or_equal:start_date'],
            'estimated_hours' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
