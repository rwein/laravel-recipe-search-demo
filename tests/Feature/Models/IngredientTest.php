<?php

namespace Tests\Feature\Models;

use App\Models\Ingredient;
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
}
