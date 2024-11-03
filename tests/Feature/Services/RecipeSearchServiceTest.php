<?php

namespace Tests\Feature\Services;

use App\Models\Author;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use App\Services\Search\RecipeSearchServiceConfiguration;
use App\Services\Search\RecipeSearchServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class RecipeSearchServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prevent using transactions for this test. The fulltext search indexes do not update within a transaction, and
     * the tests will fail.
     *
     * @var array
     */
    public $connectionsToTransact = [];

    /**
     * Verifies that our service will return all available results without any configuration applied. We want
     * this to be sort of an indexing service that can also filter/search.
     */
    public function test_search_returns_all_paginated_recipes_without_configuration(): void
    {
        $recipes = Recipe::factory()->count(3)->create();

        /** @var RecipeSearchServiceInterface $service */
        $service = app(RecipeSearchServiceInterface::class);

        $results = $service->paginate(new RecipeSearchServiceConfiguration);

        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
        $this->assertCount(3, $results);
    }

    /**
     * Verify we can search for emails (exact match)
     */
    public function test_search_matches_emails(): void
    {
        $recipes = Recipe::factory()->count(2)->create();

        /** @var RecipeSearchServiceInterface $service */
        $service = app(RecipeSearchServiceInterface::class);

        $results = $service->paginate(new RecipeSearchServiceConfiguration(
            email: $recipes->first()->author->email
        ));

        $this->assertCount(1, $results);
        $this->assertEquals(
            $results->collect()->first()->id,
            $results->first()->id
        );
    }

    /**
     * Verify we can search for keywords (exact match)
     */
    public function test_search_matches_keywords(): void
    {
        // Insert a recipe that won't be in our final result
        $nonMatchingRecipe = Recipe::factory()->create();

        // Verify that titles match for keywords
        $recipeWithMatchingTitle = Recipe::factory()->create([
            'name' => 'Long name with keyword',
        ]);

        // Verify that descriptions match for keywords
        $recipeWithMatchingDescription = Recipe::factory()->create([
            'description' => 'Long description with keyword',
        ]);

        // Verify that ingredients match for keywords
        $recipeWithMatchingIngredient = Recipe::factory()->create();
        $recipeWithMatchingIngredient->ingredients()->attach(
            Ingredient::factory()->create([
                'name' => 'Ingredient with keyword',
            ]),
            [
                'amount' => 1,
            ]
        );

        // Verify that steps match for keywords
        $recipeWithMatchingStep = Recipe::factory()->create();
        Step::factory()->create([
            'instructions' => 'Instruction with keyword',
            'recipe_id' => $recipeWithMatchingStep->id,
        ]);

        /** @var RecipeSearchServiceInterface $service */
        $service = app(RecipeSearchServiceInterface::class);

        $results = $service->paginate(new RecipeSearchServiceConfiguration(
            keyword: 'keyword'
        ));

        $this->assertCount(4, $results);
        $this->assertContains($recipeWithMatchingTitle->id, $results->pluck('id')->all());
        $this->assertContains($recipeWithMatchingDescription->id, $results->pluck('id')->all());
        $this->assertContains($recipeWithMatchingIngredient->id, $results->pluck('id')->all());
        $this->assertContains($recipeWithMatchingStep->id, $results->pluck('id')->all());
    }

    /**
     * Verify we do not partial match keywords right now. That is, the word must be an exact match.
     */
    public function test_search_does_not_partial_match_keywords(): void
    {
        $recipe = Recipe::factory()->create([
            'name' => 'Long name with keyword',
        ]);

        /** @var RecipeSearchServiceInterface $service */
        $service = app(RecipeSearchServiceInterface::class);

        $results = $service->paginate(new RecipeSearchServiceConfiguration(
            keyword: 'keywor'
        ));

        $this->assertCount(0, $results);
    }

    /**
     * Verify we can search for ingredients
     */
    public function test_search_matches_ingredients(): void
    {
        $recipes = Recipe::factory()->count(2)->create();

        $recipes->first()->ingredients()->attach(
            Ingredient::factory()->create([
                'name' => 'Large potatoes',
            ]),
            [
                'amount' => 1,
            ]
        );

        /** @var RecipeSearchServiceInterface $service */
        $service = app(RecipeSearchServiceInterface::class);

        // Ensure we can do an exact match
        $exactMatch = $service->paginate(new RecipeSearchServiceConfiguration(
            ingredient: 'Large potatoes'
        ));

        // Ensure partial matches with a full term present work
        $partialMatchFullTerm = $service->paginate(new RecipeSearchServiceConfiguration(
            ingredient: 'potatoes'
        ));

        // Ensure partial matches with a partial term work
        $partialMatchPartialTerm = $service->paginate(new RecipeSearchServiceConfiguration(
            ingredient: 'pota'
        ));

        $this->assertCount(1, $exactMatch);
        $this->assertCount(1, $partialMatchFullTerm);
        $this->assertCount(1, $partialMatchPartialTerm);
    }

    /**
     * Verify our service will query each term as an AND condition. Results should match all conditions.
     */
    public function test_search_matches_all_configuration_provided(): void
    {
        // Add in a recipe that we'll search for by email, ingredient, and keyword (in a step).
        $matchingRecipe = Recipe::factory()->create([
            'author_id' => Author::factory([
                'email' => 'foo@bar.com',
            ]),
        ]);
        $matchingRecipe->ingredients()->attach(Ingredient::factory()->create([
            'name' => 'Large Potato',
        ]), ['amount' => 1]);
        Step::factory()->create([
            'recipe_id' => $matchingRecipe->id,
            'instructions' => 'Add in the scallops',
        ]);

        // Add in a very similar recipe that should match our keyword and ingredient search, but will fail the email
        // search. It should not be in our result.
        $nonMatchingRecipe = Recipe::factory()->create();
        $nonMatchingRecipe->ingredients()->attach(Ingredient::factory()->create([
            'name' => 'Small Potato',
        ]), ['amount' => 1]);
        Step::factory()->create([
            'recipe_id' => $nonMatchingRecipe->id,
            'instructions' => 'Add in the scallops',
        ]);

        /** @var RecipeSearchServiceInterface $service */
        $service = app(RecipeSearchServiceInterface::class);

        $results = $service->paginate(new RecipeSearchServiceConfiguration(
            email: 'foo@bar.com',
            keyword: 'scallops',
            ingredient: 'Potato'
        ));

        $this->assertCount(1, $results);
        $this->assertEquals(
            $matchingRecipe->id,
            $results->collect()->first()->id
        );
    }
}
