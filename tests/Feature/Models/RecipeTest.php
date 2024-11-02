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
}
