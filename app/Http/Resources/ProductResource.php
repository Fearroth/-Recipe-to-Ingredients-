<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductRecipe;

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
            'id' => $this->{Product::ID},
            'name' => $this->{Product::NAME},
            'products' => [
                'quantity' => $this->pivot->{ProductRecipe::QUANTITY},
                'unit' => $this->pivot->{ProductRecipe::UNIT},
            ],
        ];
    }
}