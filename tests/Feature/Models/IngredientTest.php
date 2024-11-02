<?php

namespace Tests\Feature\Models;

use App\Models\Ingredient;
use App\Models\IngredientUnit;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test just to ensure we can create a new ingredient via a factory.
     */
    public function test_an_ingredient_can_be_created(): void
    {
        $ingredient = Ingredient::factory()->create();

        $this->assertDatabaseHas(Ingredient::class, ['id' => $ingredient->id]);
    }

    /**
     * Verify the recipe pivot relationship works as intended.
     */
    public function test_an_ingredient_belongs_to_many_recipes()
    {
        $ingredient = Ingredient::factory()->create();
        $recipes = Recipe::factory(3)->create();

        $ingredient->recipes()->attach($recipes, [
            'unit' => IngredientUnit::G,
            'amount' => 100,
        ]);

        $this->assertEquals(
            $ingredient->recipes->pluck('id')->toArray(),
            $recipes->pluck('id')->toArray()
        );
    }
}
