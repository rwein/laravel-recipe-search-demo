<?php

namespace Tests\Feature\Services;

use App\Models\Recipe;
use App\Services\RecipeSlugServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeSlugServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure a slug can be generated in the simplest case: there are no duplicate slugs.
     */
    public function test_generates_a_slug()
    {
        $recipe = Recipe::factory()->make([
            'name' => 'Macaroni and Cheese',
        ]);

        $slug = app(RecipeSlugServiceInterface::class)->generate($recipe);

        $this->assertEquals('macaroni-and-cheese', $slug);
    }

    /**
     * Ensure a slug can be generated when there are duplicates.
     */
    public function test_generates_a_unique_slug()
    {
        $recipe1 = Recipe::factory()->create([
            'name' => 'Macaroni and Cheese',
            'slug' => 'macaroni-and-cheese',
        ]);
        $recipe2 = Recipe::factory()->make([
            'name' => 'Macaroni and Cheese',
        ]);

        $slug = app(RecipeSlugServiceInterface::class)->generate($recipe2);

        $this->assertEquals('macaroni-and-cheese-1', $slug);
    }

    /**
     * Ensure a slug can be generated when there are unexpected duplicates. This is an edge case in which the slug
     * increment we think should be available is not, and we need to loop until one is available.
     */
    public function test_handle_unexpected_duplicates()
    {
        // Insert a recipe that will conflict with the slug we'll originally generate
        $recipe1 = Recipe::factory()->create([
            'name' => 'Macaroni and Cheese',
            'slug' => 'macaroni-and-cheese',
        ]);
        // Insert a recipe that has the slug our service will think is available. This kind of situation could happen
        // if "macaroni-and-cheese-1" got deleted, for example.
        $recipe2 = Recipe::factory()->create([
            'name' => 'Macaroni and Cheese',
            'slug' => 'macaroni-and-cheese-2',
        ]);
        $recipe3 = Recipe::factory()->make([
            'name' => 'Macaroni and Cheese',
        ]);

        $slug = app(RecipeSlugServiceInterface::class)->generate($recipe3);

        $this->assertEquals('macaroni-and-cheese-3', $slug);
    }
}
