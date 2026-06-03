<?php

namespace App\Http\Requests\Admin\Product;

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
            $this->translatableRules([
                'name'               => true,
                'description'        => false,
                'packaging'          => false,
                'country_of_origin'  => false,
                'how_to_use'         => false,
                'storage_conditions' => false,
                'expiry_date_text'   => false,
                'harvest_season'     => false,
                'notes'              => false,
            ]),
            [
                'link'              => 'nullable|url|max:255',
                'category_id'       => 'nullable|exists:categories,id',
                'product_group_id'  => 'nullable|exists:product_groups,id',
                'status'            => generalStatusRule(),
                'images.*'          => 'nullable|file|mimes:jpeg,jpg,png,gif,webp|max:10240',
                'videos.*'          => 'nullable|file|mimes:mp4,mov,avi,wmv,flv,webm|max:51200',
            ]
        );
    }
}
