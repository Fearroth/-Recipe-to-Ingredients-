<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title'=> utf8_encode($this->title),
            'author'=> utf8_encode($this->author),
            'ingredients'=> utf8_encode($this->ingredients),
            'instructions'=>($this->instructions),
            
        ];
    }
}
