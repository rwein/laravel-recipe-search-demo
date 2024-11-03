<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRecipes;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use App\Services\Search\RecipeSearchServiceConfiguration;
use App\Services\Search\RecipeSearchServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RecipeController extends Controller
{
    public function __construct(protected RecipeSearchServiceInterface $recipeSearchService) {}

    public function index(IndexRecipes $request): AnonymousResourceCollection
    {
        // Ignore typing issues about each input being a mixed type -- technically this is true but our form request
        // will ensure each of these are strings. There might be some better way to get PHPStan to understand this,
        // but I am ignoring it for now.
        $paginator = $this->recipeSearchService->paginate(new RecipeSearchServiceConfiguration(
            /** @phpstan-ignore-next-line */
            email: $request->input('email'),
            /** @phpstan-ignore-next-line */
            keyword: $request->input('keyword'),
            /** @phpstan-ignore-next-line */
            ingredient: $request->input('ingredient'),
        ));

        return RecipeResource::collection($paginator);
    }

    public function get(Recipe $recipe): RecipeResource
    {
        $recipe->load(['ingredients', 'steps', 'author']);

        return RecipeResource::make($recipe);
    }
}
