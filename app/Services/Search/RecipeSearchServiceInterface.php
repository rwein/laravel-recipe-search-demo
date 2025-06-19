<?php

namespace App\Services\Search;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface RecipeSearchServiceInterface
{
    /**
     * @return Builder<Recipe>
     */
    public function getQuery(RecipeSearchServiceConfiguration $configuration): Builder;

    /**
     * @return LengthAwarePaginator<int, Recipe>
     */
    public function paginate(RecipeSearchServiceConfiguration $configuration): LengthAwarePaginator;
}
