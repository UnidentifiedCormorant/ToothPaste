<?php

namespace App\Http\Resources\Pasta;

use App\Domain\Enum\AccessType;
use App\Models\Pasta;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Pasta
 */
class PastaResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'author' => $this->user_id ? $this->user->name : "Аноним",
            'access_type' => AccessType::from($this->access_type)->title()
        ];
    }
}
