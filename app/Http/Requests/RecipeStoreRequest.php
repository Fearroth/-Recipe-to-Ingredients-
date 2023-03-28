<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Recipe;

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
            Recipe::TITLE => ['required', 'string', 'min:10', 'max:255', Rule::unique(Recipe::TABLE)],
            Recipe::AUTHOR => ['required', 'string', 'min:10', 'max:255'],
            Recipe::INGREDIENTS => ['required', 'string', 'min:10', 'max:21845'],
            Recipe::INSTRUCTIONS => ['required', 'string', 'min:30', 'max:21845'],
        ];
    }
}