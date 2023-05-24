<?php

namespace App\Http\Resources\User;

use App\Domain\Entity\AuthEntity;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
* @mixin AuthEntity
 */
class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->user->name,
            'banned' => $this->user->banned,
            'token' => $this->token
        ];
    }
}
