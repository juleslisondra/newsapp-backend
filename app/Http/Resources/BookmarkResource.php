<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BookmarkResource extends JsonResource
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
            'title' => $this->title,
            'url' => $this->url,
            'type' => $this->type,
            'section_id' => $this->section_id,
            'section_name' => $this->section_name,
            'published_date' => Carbon::parse($this->published_date)->format('Y-m-d'),
            'user' => $this->whenLoaded('user', function(){
                return new UserResource($this->user);
            }),
        ];
    }
}
