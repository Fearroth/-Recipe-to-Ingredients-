<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    public const TABLE = 'products';
    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';
    public const NAME = 'name';

    protected $guarded = [
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
    //Relations
    public const RELATION_RECIPES = 'recipes';

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'product_recipe', 'product_id', 'recipe_id')
            ->withTimestamps()
            ->withPivot(['quantity', 'unit']);
    }

}