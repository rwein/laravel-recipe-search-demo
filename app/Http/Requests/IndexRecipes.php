<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\RecipeController;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Responsible for typing/checking the params we accept when indexing recipes.
 *
 * @see RecipeController
 */
class IndexRecipes extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'sometimes|email',
            'keyword' => 'sometimes|string',
            'ingredients' => 'sometimes|string',
        ];
    }
}
