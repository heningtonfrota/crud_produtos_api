<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'description' => $this->description,
            'price' => $this->price,
            'expiration_date' => $this->expiration_date,
            'image' => Storage::url('public/products/' . $this->image),
            'category' => [
                'id' => $this->category_id,
                'name' => $this->whenLoaded('category')->name
            ]
        ];
    }
}
