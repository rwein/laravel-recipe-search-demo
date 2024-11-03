<?php

namespace Tests\Feature\Models;

use App\Models\IngredientRecipe;
use App\Models\IngredientUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see IngredientRecipe
 */
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

    /**
     * This is a basic test to ensure that when we access a unit, it's as an enum.
     */
    public function test_ensure_units_are_casted_to_enums(): void
    {
        $pivot = IngredientRecipe::factory()->create([
            'unit' => IngredientUnit::CUP,
        ]);

        $this->assertInstanceOf(IngredientUnit::class, $pivot->unit);
    }

    /**
     * This is a basic test to ensure that we can have a null unit. For example, if our recipe calls for 1 potato, we
     * don't really want to have a unit there.
     */
    public function test_ensure_units_can_be_null(): void
    {
        $pivot = IngredientRecipe::factory()->create([
            'unit' => null,
        ]);

        $this->assertNull($pivot->unit);
        $this->assertNull($pivot->unit_display_name);
    }

    /**
     * Test to ensure that we can cast to the correct display name (null, singular, or plural).
     */
    public function test_casts_to_expected_display_name(): void
    {
        $singular = IngredientRecipe::factory()->create([
            'unit' => IngredientUnit::CUP,
            'amount' => 1,
        ]);

        $plural = IngredientRecipe::factory()->create([
            'unit' => IngredientUnit::CUP,
            'amount' => 10,
        ]);

        $null = IngredientRecipe::factory()->create([
            'unit' => null,
        ]);

        $this->assertEquals($singular->unit_display_name, IngredientUnit::CUP->displayNameSingular());
        $this->assertEquals($plural->unit_display_name, IngredientUnit::CUP->displayNamePlural());
        $this->assertNull($null->unit_display_name);
    }
}
