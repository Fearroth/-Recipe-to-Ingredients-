<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Recipe;

//use App\Models\User;

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
            'authorId' => $this->{Recipe::AUTHOR_ID},
            //USER::NAME => $this->user->name,
            'ingredients' => $this->{Recipe::INGREDIENTS},
            'instructions' => $this->{Recipe::INSTRUCTIONS},
        ];
    }
}