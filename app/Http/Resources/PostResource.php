<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/*
 * Kind of like a response DTO
 */

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'owner' => $this->user->username,
            'caption' => $this->caption,
            'message' => $this->message,
            'is_private' => $this->is_private,
            'status' => $this->status->value,
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
