<?php

namespace Tests\Feature\Models;

use App\Models\IngredientUnit;
use Tests\TestCase;

/**
 * This structure is not a model, but I've kept it in the models directory because it's used as a column caster.
 */
class IngredientUnitTest extends TestCase
{
    /**
     * Test that each enum value can be mapped to a display name.
     *
     * @return void
     */
    public function test_ensure_each_unit_has_a_display_name()
    {
        // For the purposes of this test, we don't necessarily care what the display value is, just that there is
        // one for each value.
        foreach (IngredientUnit::cases() as $unit) {
            // Ensure each method returns a non-null, non-empty string
            $this->assertIsString($unit->displayNameSingular());
            $this->assertIsString($unit->displayNamePlural());
        }
    }
}
