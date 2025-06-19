<?php

namespace App\Services\Search\Modifiers;

use App\Models\Recipe;
use App\Services\Search\RecipeSearchService;
use App\Services\Search\RecipeSearchServiceConfiguration;
use Illuminate\Database\Eloquent\Builder;

/**
 * Interface to describe modifier classes that can be consumed by our main search service. These get plugged in as
 * strategies and their purpose is to accept a configuration and modify the builder in a way that is appropraite to
 * the concern they are handling (e.g. email search).
 *
 * @see RecipeSearchService
 */
interface QueryModifierInterface
{
    /**
     * @param  Builder<Recipe>  $query
     */
    public function apply(Builder $query, RecipeSearchServiceConfiguration $configuration): void;
}
