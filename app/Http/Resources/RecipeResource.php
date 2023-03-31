<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Htpp\Resources\{
    UserResource,
};

use App\Models\Recipe;

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
            'id' => $this->{Recipe::ID},
            'title' => $this->{Recipe::TITLE},
            'author' => $this->{Recipe::AUTHOR_ID} && $this->{Recipe::RELATION_AUTHOR}
                ? new UserResource($this->{Recipe::RELATION_AUTHOR})
                : null,
            'ingredients' => $this->{Recipe::INGREDIENTS},
            'instructions' => $this->{Recipe::INSTRUCTIONS},
        ];
    }
}
