<?php

namespace App\Services\Search;

use App\Http\Controllers\Api\RecipeController;
use App\Models\Recipe;
use App\Services\Search\Modifiers\EmailSearchModifier;
use App\Services\Search\Modifiers\IngredientSearchModifier;
use App\Services\Search\Modifiers\KeywordSearchModifier;
use App\Services\Search\Modifiers\QueryModifierInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Tests\Feature\Services\RecipeSearchServiceTest;

/**
 * Our main search service. This can accept a configuration object and return a paginated list of matches (or, it can
 * return the base builder for other services to consume).
 *
 * Note that this is built on top of a series of "query modifiers" that are actually responsible for each of the search
 * concerns (e.g. by email, by keyword, by ingredient). Doing this is not strictly necessary, but I like to set up
 * services with strategies like this, when appropriate.
 *
 * @see RecipeController for its use
 * @see RecipeSearchServiceTest for tests
 */
class RecipeSearchService implements RecipeSearchServiceInterface
{
    /**
     * Our list of modifiers that will be applied to the query.
     *
     * @var array<int, class-string<QueryModifierInterface>>
     */
    public array $queryModifiers = [
        EmailSearchModifier::class,
        KeywordSearchModifier::class,
        IngredientSearchModifier::class,
    ];

    /**
     * @return Builder<Recipe>
     */
    public function getQuery(RecipeSearchServiceConfiguration $configuration): Builder
    {
        $query = Recipe::query();

        $this->getModifiers()
            ->each(function (QueryModifierInterface $queryModifier) use ($query, $configuration) {
                $queryModifier->apply($query, $configuration);
            });

        return $query;
    }

    /**
     * @return Collection<int, QueryModifierInterface>
     */
    protected function getModifiers(): Collection
    {
        return collect($this->queryModifiers)
            ->map(fn (string $modifierClass) => app($modifierClass));
    }

    /**
     * @return LengthAwarePaginator<int, Recipe>
     */
    public function paginate(RecipeSearchServiceConfiguration $configuration): LengthAwarePaginator
    {
        return $this->getQuery($configuration)->paginate();
    }
}
