<?php

namespace App\Http\Resources\User;

use App\Enums\UserTypeEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $token               = '';

    public function setToken($value)
    {
        $this->token = $value;
        return $this;
    }

    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'email'          => $this->email,
            'phone'          => $this->full_phone,
            'image'          => $this->image,
            'lang'           => $this->lang,
            'type'          => UserTypeEnum::toResource($this->type),
            'city' => [
                'id'   => $this?->city?->id,
                'name' => $this?->city?->name,
            ],
            'region' => [
                'id'   => $this?->region?->id,
                'name' => $this?->region?->name,
            ],
            'token'          => $this->token,
        ];
    }
}
