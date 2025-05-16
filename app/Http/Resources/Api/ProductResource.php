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
            'category' => $this->whenLoaded('category', fn () => $this->category?->name),
    
            'images' => $this->productImages->map(fn ($img) => asset('storage/' . $img->image)),
            'colors' => $this->colors->map(function ($color) {
                return [
                    'name' => $color->name,
                    'image' => asset('storage/' . $color->image),
                ];
            }),

        ];
    }
}
