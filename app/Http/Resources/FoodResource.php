<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'image' => ImageResource::collection($this->images),
            'category' => new Food_categoryResource($this->category),
            'description' => $this->descripton,
            'is_active' => $this->is_active,
            'sizes' => SizeResource::collection($this->sizes),
        ];

        return $data;
    }
}
