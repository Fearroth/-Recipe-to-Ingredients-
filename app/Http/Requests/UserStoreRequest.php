<?php

namespace App\Http\Requests;

use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserStoreRequest extends FormRequest
{
    public $errors;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get additional data to validation
     *
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::NAME => [
                'required',
                'string',
                'max:255'
            ],
            User::EMAIL => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::TABLE, User::EMAIL)
            ],
            User::PASSWORD => [
                'required',
                'string',
                'min:8'
            ],
        ];
    }
}