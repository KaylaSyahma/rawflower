<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'original_price' => $this->original_price,
            'quantity' => $this->quantity,
            'popular' => $this->popular,
            'status' => $this->status,
    
            // Include relasi
            'category' => $this->whenLoaded('category', function () {
                return $this->category->name;
            }),
    
            'images' => $this->whenLoaded('productImages', fn () => $this->productImages->pluck('image')),
            'colors' => $this->whenLoaded('colors', fn () => $this->colors->pluck('name')),

        ];
    }
}
