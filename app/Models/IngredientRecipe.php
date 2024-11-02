<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $amount
 * @property string|null $unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ingredient_id
 * @property int $recipe_id
 *
 * @method static \Database\Factories\IngredientRecipeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe whereIngredientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IngredientRecipe whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class IngredientRecipe extends Pivot
{
    /** @use HasFactory<\Database\Factories\IngredientRecipeFactory> */
    use HasFactory;
}
