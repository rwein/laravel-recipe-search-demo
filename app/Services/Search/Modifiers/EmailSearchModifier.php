<?php

namespace App\Services\Search\Modifiers;

use App\Models\Recipe;
use App\Services\Search\RecipeSearchServiceConfiguration;
use Illuminate\Database\Eloquent\Builder;

class EmailSearchModifier implements QueryModifierInterface
{
    /**
     * @param  Builder<Recipe>  $query
     */
    public function apply(Builder &$query, RecipeSearchServiceConfiguration $configuration): void
    {
        if (! $configuration->email) {
            return;
        }

        $query->whereHas('author', function (Builder $query) use ($configuration) {
            $query->whereRaw(
                'MATCH(email) AGAINST (? IN BOOLEAN MODE)',
                // Wrap our email in double quotes to instruct Mysql to get an exact match.
                // See https://dev.mysql.com/doc/refman/8.4/en/fulltext-boolean.html
                ['"'.$configuration->email.'"']);
        });
    }
}
