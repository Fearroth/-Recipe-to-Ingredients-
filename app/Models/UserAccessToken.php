<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccessToken extends Model
{
    use HasFactory;

    protected $table = 'users';
    public const TABLE = 'users';

    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const USER_ID = 'user_id';
    public const TOKEN = 'token';
    public const VALID_TO = 'valid_to';

    protected $guarded = [
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    /*
    * RELATIONS
    */
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(User::class, User::ID, self::USER_ID);
    }
}
