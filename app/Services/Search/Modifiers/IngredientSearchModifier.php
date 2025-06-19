<?php

namespace App\Services\Search\Modifiers;

use App\Models\Recipe;
use App\Services\Search\RecipeSearchServiceConfiguration;
use Illuminate\Database\Eloquent\Builder;

/**
 * Responsible for configuring our builder to partial match ingredients.
 *
 * Gets consumed by our main service. @see RecipeSearchService
 */
class IngredientSearchModifier implements QueryModifierInterface
{
    /**
     * @param  Builder<Recipe>  $query
     */
    public function apply(Builder $query, RecipeSearchServiceConfiguration $configuration): void
    {
        if (! $configuration->ingredient) {
            return;
        }

        $query->whereHas('ingredients', function (Builder $query) use ($configuration) {
            // Partial keyword match against the recipe's instruction list. Boolean mode allows us to partially match.
            $query->whereRaw('MATCH(name) AGAINST (? IN BOOLEAN MODE)', [$configuration->ingredient.'*']);
        });
    }
}
