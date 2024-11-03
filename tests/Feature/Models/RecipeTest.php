<?php

namespace Tests\Feature\Models;

use App\Models\Ingredient;
use App\Models\IngredientUnit;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see Recipe
 */
class RecipeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test just to ensure we can create a new recipe via a factory.
     */
    public function test_a_recipe_can_be_created(): void
    {
        $recipe = Recipe::factory()->create();

        $this->assertDatabaseHas(Recipe::class, ['id' => $recipe->id]);
    }

    /**
     * Test to ensure that we're generating slugs whenever a model is created. A more extensive test might be to
     * mock the actual slug generation service and make sure it's being called here, but I think this is okay for now.
     */
    public function test_a_recipe_has_a_slug_set_on_create(): void
    {
        $recipe = Recipe::factory()->make([
            'name' => 'Mac and Cheese',
            'slug' => null,
        ]);

        $recipe->save();

        $this->assertEquals('mac-and-cheese', $recipe->slug);
    }

    /**
     * This ensures that a slug can be manually set on creation and it is not overridden by our automatic slug generator.
     */
    public function test_a_slug_can_be_manually_set_on_creation(): void
    {
        $recipe = Recipe::factory()->make([
            'name' => 'Mac and Cheese',
            'slug' => 'override-slug',
        ]);

        $recipe->save();

        $this->assertEquals('override-slug', $recipe->slug);
    }

    /**
     * Verify the ingredient pivot relationship works as intended.
     */
    public function test_a_recipe_belongs_to_many_ingredients()
    {
        $recipe = Recipe::factory()->create();
        $ingredients = Ingredient::factory(3)->create();

        $recipe->ingredients()->attach($ingredients, [
            'unit' => IngredientUnit::G,
            'amount' => 100,
        ]);

        $this->assertEquals(
            $recipe->ingredients()->pluck('id')->toArray(),
            $ingredients->pluck('id')->toArray()
        );
    }

    /**
     * Verify the steps relationship functions as expected.
     */
    public function test_a_recipe_has_many_steps(): void
    {
        $recipe = Recipe::factory()->create();
        $steps = Step::factory(3)->create([
            'recipe_id' => $recipe->id,
        ]);

        $this->assertEquals(
            $recipe->steps()->pluck('id')->toArray(),
            $steps->sortBy('order')->pluck('id')->toArray()
        );
    }
}
