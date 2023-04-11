<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\UserAccessToken;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



class UserAccessTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->{UserAccessToken::TOKEN},
            'userId' => $this->{UserAccessToken::RELATION_USER}->{User::ID},
            'isAdmin' => $this->{UserAccessToken::RELATION_USER}->{User::IS_ADMIN},
        ];
    }
}