<?php

namespace App\Base\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class ApiRequest extends FormRequest
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
    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        if (!empty($errors)) {
            $transFormedErrors = [];
            // foreach ($errors as $field => $message) {
            //     $transFormedErrors[] = [
            //         $field => $message[0],
            //     ];
            // }
            foreach ($errors as $key => $value) {
                $transFormedErrors[$key] = $value[0];
                break;
            }

            throw new HttpResponseException(response()->json(
                [
                    'status'    => false,
                    'message'   => $transFormedErrors[array_key_first($transFormedErrors)],
                    'errors'    => $transFormedErrors
                ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            ));
        }
    }
}
