<?php

namespace App\Listeners;

use App\Events\RecipeCreatingEvent;
use App\Services\RecipeSlugServiceInterface;

class GenerateRecipeSlug
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public RecipeSlugServiceInterface $recipeSlugService
    ) {}

    /**
     * Handle the event.
     */
    public function handle(RecipeCreatingEvent $event): void
    {
        // Only set a slug if one has not been manually set by whomever is attempting to create a recipe. This is an
        // "escape hatch" of sorts -- there could be situation in the future in which an author/admin would want to
        // opt out of automatic slug creation.
        if ($event->recipe->slug !== null) {
            return;
        }

        // Passed by reference so we can just set it here -- this is a hook that runs *before* the model is originally
        // inserted into the DB
        $event->recipe->slug = $this->recipeSlugService->generate($event->recipe);
    }
}
