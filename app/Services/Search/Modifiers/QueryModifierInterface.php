<?php

namespace App\Services\Search\Modifiers;

use App\Models\Recipe;
use App\Services\Search\RecipeSearchServiceConfiguration;
use Illuminate\Database\Eloquent\Builder;

interface QueryModifierInterface
{
    /**
     * @param  Builder<Recipe>  $query
     */
    public function apply(Builder &$query, RecipeSearchServiceConfiguration $configuration): void;
}
