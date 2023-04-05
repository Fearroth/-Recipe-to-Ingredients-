<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'recipes';
    public const TABLE = 'recipes';

    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';
    public const TITLE = 'title';
    public const AUTHOR_ID = 'author_id';
    public const INSTRUCTIONS = 'instructions';

    protected $guarded = [
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];
    protected $casts = [
        self::INSTRUCTIONS => 'array',
    ];
    //Relations
    public const RELATION_AUTHOR = 'author';
    public const RELATION_PRODUCTS = 'products';
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, self::AUTHOR_ID, User::ID);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps()
            ->withPivot(['quantity', 'unit']);
         
    }
}