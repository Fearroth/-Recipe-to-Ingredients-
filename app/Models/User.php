<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    public const TABLE = 'users';
    public function recipe(): HasMany
    {
        return $this->hasMany(Recipe::class, 'author', "name");
    }


    protected $table = 'users';
    public const TABLE = 'users';

    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';


    protected $guarded = [
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,

    ];

    protected $hidden = [
        self::PASSWORD,

    ];

    /*
    * RELATIONS
    */
    public function recipe(): HasMany
    {
        return $this->hasMany(Recipe::class, 'author', "name");
    }
}

