<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Recipe;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class RecipeUpdateRequest extends FormRequest
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
            Recipe::TITLE => [
                'required',
                'string',
                'min:10',
                'max:255',
                Rule::unique(Recipe::TABLE, Recipe::TITLE)
                    ->ignore($this->route('model')->{Recipe::ID}),
            ],
            Recipe::AUTHOR_ID => [
                'required',
                'uuid',
                Rule::exists(User::TABLE, User::ID),
            ],
            Recipe::INSTRUCTIONS => [
                'required',
                'string',
                'min:30',
                'max:21845'
            ],
        ];
    }
}