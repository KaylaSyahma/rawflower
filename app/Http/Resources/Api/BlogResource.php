<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'image' => $this->image,
            'judul' => $this->judul,
            'isi' => $this->isi,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'published_at' => $this->published_at
        ];
    }
}
