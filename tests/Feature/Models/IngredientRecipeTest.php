<?php

namespace Tests\Feature\Models;

use App\Models\IngredientRecipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientRecipeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test just to ensure we can create a new pivot entry via a factory.
     */
    public function test_a_pivot_record_can_be_created(): void
    {
        $pivot = IngredientRecipe::factory()->create();

        $this->assertDatabaseHas(IngredientRecipe::class, [
            'ingredient_id' => $pivot->ingredient_id,
            'recipe_id' => $pivot->recipe_id,
        ]);
    }
}
