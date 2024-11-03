<?php

namespace App\Services\Search;

use App\Models\Recipe;
use App\Services\Search\Modifiers\EmailSearchModifier;
use App\Services\Search\Modifiers\IngredientSearchModifier;
use App\Services\Search\Modifiers\KeywordSearchModifier;
use App\Services\Search\Modifiers\QueryModifierInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RecipeSearchService implements RecipeSearchServiceInterface
{
    /**
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
     * @return LengthAwarePaginator<Recipe>
     */
    public function paginate(RecipeSearchServiceConfiguration $configuration): LengthAwarePaginator
    {
        return $this->getQuery($configuration)->paginate();
    }
}
