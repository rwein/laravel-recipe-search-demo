<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model that attaches ingredients and recipes.
 *
 * @property int $amount
 * @property IngredientUnit|null $unit
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
 * @property-read string|null $unit_display_name
 *
 * @mixin \Eloquent
 */
class IngredientRecipe extends Pivot
{
    /** @use HasFactory<\Database\Factories\IngredientRecipeFactory> */
    use HasFactory;

    protected $casts = [
        'unit' => IngredientUnit::class,
    ];

    /**
     * When getting the amount, cast to an integer when possible.
     *
     * @return Attribute<int|float, null>
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            /** @phpstan-ignore-next-line - we know this will always be an int or float */
            get: fn (int|float $amount) => intval($amount) == $amount ? intval($amount) : $amount,
        );
    }

    /**
     * Grabs the right display name based on the amount set for the ingredient.
     */
    public function getUnitDisplayNameAttribute(): ?string
    {
        if (! $this->unit) {
            return null;
        }

        return $this->amount > 1
            ? $this->unit->displayNamePlural()
            : $this->unit->displayNameSingular();
    }
}
