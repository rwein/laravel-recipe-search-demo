<?php

namespace App\Services\Search\Modifiers;

use App\Models\Recipe;
use App\Services\Search\RecipeSearchServiceConfiguration;
use Illuminate\Database\Eloquent\Builder;

/**
 * Responsible for configuring our query builder to get recipe matches based on a keyword. Matches against: recipe
 * title, recipe description, ingredient name, and step instructions. Does *not* partial match (but could be modified
 * to easily).
 *
 * Gets consumed by our main service. @see RecipeSearchService
 */
class KeywordSearchModifier implements QueryModifierInterface
{
    /**
     * @param  Builder<Recipe>  $query
     */
    public function apply(Builder $query, RecipeSearchServiceConfiguration $configuration): void
    {
        if (! $configuration->keyword) {
            return;
        }

        $query->where(function (Builder $query) use ($configuration) {
            // Note: for partial matches, use boolean mode with a wildcard. See EmailSearchModifier for an example.
            // Otherwise, for exact matches, we can use natural language mode (with whereFullText()).

            // Keyword match against the recipe's name
            $query->whereFullText('name', $configuration->keyword)
                // Keyword match against the recipe's description
                ->orWhereFullText('description', $configuration->keyword)
                // Keyword match against the recipe's ingredient list
                ->orWhereHas('ingredients', function (Builder $query) use ($configuration) {
                    $query->whereFullText('name', $configuration->keyword);
                })
                // Keyword match against the recipe's instruction list
                ->OrWhereHas('steps', function (Builder $query) use ($configuration) {
                    $query->whereFullText('instructions', $configuration->keyword);
                });
        });
    }
}
