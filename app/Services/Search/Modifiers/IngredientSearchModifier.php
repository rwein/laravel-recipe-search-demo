<?php

namespace App\Services\Search\Modifiers;

use App\Models\Recipe;
use App\Services\Search\RecipeSearchServiceConfiguration;
use Illuminate\Database\Eloquent\Builder;

class IngredientSearchModifier implements QueryModifierInterface
{
    /**
     * @param  Builder<Recipe>  $query
     */
    public function apply(Builder &$query, RecipeSearchServiceConfiguration $configuration): void
    {
        if (! $configuration->ingredient) {
            return;
        }

        $query->whereHas('ingredients', function (Builder $query) use ($configuration) {
            // Partial keyword match against the recipe's instruction list
            $query->whereRaw('MATCH(name) AGAINST (? IN BOOLEAN MODE)', [$configuration->ingredient.'*']);
        });
    }
}
