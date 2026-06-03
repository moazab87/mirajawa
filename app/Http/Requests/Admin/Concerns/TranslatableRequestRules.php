<?php

namespace App\Http\Requests\Admin\Concerns;

trait TranslatableRequestRules
{
    protected function translatableRules(array $fields): array
    {
        $rules = [];
        foreach ($fields as $field => $isNameField) {
            $rules = array_merge($rules, translatableFieldRules($field, $isNameField));
        }

        return $rules;
    }
}
