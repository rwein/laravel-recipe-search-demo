<?php

namespace Tests\Feature\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientUnit;
use App\Models\Recipe;
use App\Models\Step;
use App\Services\Search\RecipeSearchService;
use App\Services\Search\RecipeSearchServiceConfiguration;
use App\Services\Search\RecipeSearchServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class RecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verify our index route returns recipes as expected
     */
    public function test_index_returns_recipes(): void
    {
        $recipes = Recipe::factory()->count(2)->create();
        $ingredient = Ingredient::factory()->create();
        $recipes->each(function (Recipe $recipe) use ($ingredient) {
            $recipe->ingredients()->attach($ingredient, ['amount' => 1, 'unit' => IngredientUnit::CUP]);
            Step::factory()->create(['recipe_id' => $recipe->id]);
        });

        $result = $this->get(route('api.recipes.index'));

        $result->assertStatus(200);
        // Make sure each of our recipes appear in the result
        $recipes->each(function (Recipe $recipe) use ($result, $ingredient) {
            $result->assertJsonFragment([
                'name' => $recipe->name,
                'description' => $recipe->description,
                'slug' => $recipe->slug,
                'author' => [
                    'email' => $recipe->author->email,
                ],
                'ingredients' => [
                    [
                        'name' => $ingredient->name,
                        'unit' => 'Cup',
                        'amount' => 1,
                    ],
                ],
                'steps' => [
                    [
                        'order' => $recipe->steps->first()->order,
                        'instructions' => $recipe->steps->first()->instructions,
                    ],
                ],
            ]);
        });
    }

    /**
     * Verify our index route defers to our search service. We have more extensive feature tests for that particular
     * service to verify all our desired behavior -- for this one, we just want to make sure we're deferring to it.
     */
    public function test_index_uses_search_service(): void
    {
        $spy = Mockery::spy(RecipeSearchService::class);
        $this->app->bind(RecipeSearchServiceInterface::class, function () use ($spy) {
            return $spy;
        });

        $this->get(route('api.recipes.index', [
            'email' => 'foo@bar.com',
            'keyword' => 'keyword',
            'ingredient' => 'ingredient',
        ]));

        // Ensure our service got called with the expected configuration
        $spy->shouldHaveReceived('paginate')
            ->withArgs(function (RecipeSearchServiceConfiguration $configuration) {
                return $configuration->email === 'foo@bar.com' &&
                    $configuration->keyword === 'keyword' &&
                    $configuration->ingredient === 'ingredient';
            });
    }

    /**
     * Verify we can grab a recipe by its slug.
     */
    public function test_get_returns_recipe(): void
    {
        $recipe = Recipe::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $recipe->ingredients()->attach($ingredient, ['amount' => 1, 'unit' => IngredientUnit::CUP]);
        Step::factory()->create(['recipe_id' => $recipe->id]);

        $result = $this->get(route('api.recipes.get', ['recipe' => $recipe]));

        $result->assertStatus(200);
        $result->assertJsonFragment([
            'name' => $recipe->name,
            'description' => $recipe->description,
            'slug' => $recipe->slug,
            'author' => [
                'email' => $recipe->author->email,
            ],
            'ingredients' => [
                [
                    'name' => $ingredient->name,
                    'unit' => 'Cup',
                    'amount' => 1,
                ],
            ],
            'steps' => [
                [
                    'order' => $recipe->steps->first()->order,
                    'instructions' => $recipe->steps->first()->instructions,
                ],
            ],
        ]);
    }
}
