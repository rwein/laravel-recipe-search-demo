<?php

namespace Tests\Feature\Models;

use App\Models\Recipe;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    /**
     * A basic test just to ensure we can create a new recipe via a factory.
     */
    public function test_a_recipe_can_be_created(): void
    {
        $recipe = Recipe::factory()->create();

        $this->assertDatabaseHas(Recipe::class, ['id' => $recipe->id]);
    }
}
