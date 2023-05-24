<?php

namespace App\Http\Resources\Complaint;

use App\Http\Resources\Pasta\PastaResource;
use App\Http\Resources\User\UserResource;
use App\Models\Complaint;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Complaint
 */
class ComplaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'content' => $this->content,
            'user' => new UserResource($this->user),
            'pasta' => new PastaResource($this->pasta),
        ];
    }
}
