<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebScrappedUrl extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'webScrappedUrls';
    public const TABLE = 'webScrappedUrls';

    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';
    public const URL = 'url';
    public const IS_SCRAPED = 'is_scraped';

    protected $guarded = [
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,

    ];
}