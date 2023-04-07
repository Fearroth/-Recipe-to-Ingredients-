<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductRecipe extends Pivot
{
    use HasFactory;

    protected $table = 'product_recipe';
    public const TABLE = 'product_recipe';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';
    public const RECIPE_ID = 'recipe_id';
    public const PRODUCT_ID = 'product_id';
    public const QUANTITY = 'quantity';
    public const UNIT = 'unit';
    protected $guarded = [

        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
    public $timestamps = true;
    //RELATIONS
    public const RELATION_RECIPES = 'recipes';
    public const RELATION_PRODUCTS = 'products';
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}