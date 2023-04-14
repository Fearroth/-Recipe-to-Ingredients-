<?php

namespace App\Http\Requests;


use App\Models\{
    Product,
    ProductRecipe,
    Recipe,
    User
};

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecipeStoreRequest extends FormRequest
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
                Rule::unique(Recipe::TABLE, Recipe::TITLE),
            ],
            Recipe::AUTHOR_ID => [
                'required',
                'string',
                // 'uuid', ??!! name changed but its still string...
                Rule::exists(User::TABLE, User::ID),
            ],
            Recipe::INSTRUCTIONS => [
                'required',
                'array',
                'min:1',
            ],
                //work to this point
            Recipe::INSTRUCTIONS . '.*' => [
                'required',
                'string',
                'min:10',
                'max:21845'
            ],

            Recipe::RELATION_PRODUCTS => [
                'required',
                'array',
                'min:1',
            ],
            Recipe::RELATION_PRODUCTS . '.*' . Product::NAME => [
                'required',
                'string',
                'max:255',

            ],
                //     // Rule::exists(Product::TABLE, Product::ID), //czy to moze byc? skoro dopiero tworze

            Recipe::RELATION_PRODUCTS . '.*' . ProductRecipe::QUANTITY => [
                'required',
                'numeric',
                'min:1'
            ],
            Recipe::RELATION_PRODUCTS . '.*' . ProductRecipe::UNIT =>
            [
                'required',
                'string',
                'min:1',
                'max:255'
            ],
        ];
    }
}