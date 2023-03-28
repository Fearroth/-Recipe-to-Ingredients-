<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Recipe;
use App\Models\User;

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
            Recipe::ID => $this->id,
            Recipe::TITLE => $this->title,
                //Recipe::AUTHOR_ID => $this->author_id,
            USER::NAME => $this->user->name,
            Recipe::INGREDIENTS => $this->ingredients,
            Recipe::INSTRUCTIONS => $this->instructions,

        ];
    }
}