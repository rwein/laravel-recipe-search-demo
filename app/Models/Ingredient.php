<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\IngredientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereUpdatedAt($value)
 *
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereName($value)
 *
 * @property-read \App\Models\IngredientRecipe|null $pivot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Recipe> $recipes
 * @property-read int|null $recipes_count
 *
 * @mixin \Eloquent
 */
class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    /**
     * @return BelongsToMany<Recipe, $this>
     */
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class)
            ->using(IngredientRecipe::class)
            ->withPivot(['unit', 'amount']);
    }
}
