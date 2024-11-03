<?php

namespace App\Services\Search\Modifiers;

use App\Models\Recipe;
use App\Services\Search\RecipeSearchServiceConfiguration;
use Illuminate\Database\Eloquent\Builder;

class KeywordSearchModifier implements QueryModifierInterface
{
    /**
     * @param  Builder<Recipe>  $query
     */
    public function apply(Builder &$query, RecipeSearchServiceConfiguration $configuration): void
    {
        if (! $configuration->keyword) {
            return;
        }

        $query->where(function (Builder $query) use ($configuration) {
            // Keyword match against the recipe's name
            $query->whereRaw('MATCH(name) AGAINST (? IN BOOLEAN MODE)', [$configuration->keyword])
                // Keyword match against the recipe's description
                ->orWhereRaw('MATCH(description) AGAINST (? IN BOOLEAN MODE)', [$configuration->keyword])
                // Keyword match against the recipe's ingredient list
                ->orWhereHas('ingredients', function (Builder $query) use ($configuration) {
                    $query->whereRaw('MATCH(name) AGAINST (? IN BOOLEAN MODE)', [$configuration->keyword]);
                })
                // Keyword match against the recipe's instruction list
                ->OrWhereHas('steps', function (Builder $query) use ($configuration) {
                    $query->whereRaw('MATCH(instructions) AGAINST (? IN BOOLEAN MODE)', [$configuration->keyword]);
                });
        });
    }
}
