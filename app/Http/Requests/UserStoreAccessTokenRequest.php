<?php

namespace App\Http\Requests;

use App\Models\{
    User,
    UserAccessToken
 };


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreAccessTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            UserAccessToken::USER_ID => [
                'required',
                'uuid',
                Rule::exists(User::TABLE, User::ID),

            ],
        ];
    }
}