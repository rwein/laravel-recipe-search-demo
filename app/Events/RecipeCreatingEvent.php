<?php

namespace App\Events;

use App\Listeners\GenerateRecipeSlug;
use App\Models\Recipe;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Tests\Feature\Models\RecipeTest;

/**
 * This event is thrown whenever a recipe is being created (but before it is inserted into the DB).
 *
 * @see GenerateRecipeSlug for the listener
 * @see RecipeTest for tests (this structure is tested indirectly)
 */
class RecipeCreatingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Recipe $recipe
    ) {}
}
