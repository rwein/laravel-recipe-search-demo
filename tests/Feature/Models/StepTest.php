<?php

namespace Tests\Feature\Models;

use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see Step
 */
class StepTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test just to ensure we can create a new step via a factory.
     */
    public function test_a_step_can_be_created(): void
    {
        $step = Step::factory()->create();

        $this->assertDatabaseHas(Step::class, ['id' => $step->id]);
    }

    /**
     * Test that the recipe relationship works as expected
     */
    public function test_a_step_belongs_to_a_recipe(): void
    {
        $step = Step::factory()->create();

        $this->assertInstanceOf(Recipe::class, $step->recipe);
    }
}
