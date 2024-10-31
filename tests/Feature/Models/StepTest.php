<?php

namespace Tests\Feature\Models;

use App\Models\Step;
use Tests\TestCase;

class StepTest extends TestCase
{
    /**
     * A basic test just to ensure we can create a new step via a factory.
     */
    public function test_a_step_can_be_created(): void
    {
        $step = Step::factory()->create();

        $this->assertDatabaseHas(Step::class, ['id' => $step->id]);
    }
}
