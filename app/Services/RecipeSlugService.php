<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeSlugService implements RecipeSlugServiceInterface
{
    /**
     * Accepts a recipe and generates a new, unique slug for it. Implementers are responsible for actually taking this
     * slug and saving it.
     */
    public function generate(Recipe $recipe): string
    {
        $slug = Str::slug($recipe->name);

        // Get any other slugs that have the same base as ours in a single query. We don't want to be running multiple
        // queries when getting a unique slug as that isn't as efficient as a single query.
        $existingSlugs = Recipe::where('slug', 'like', "$slug%")
            // Not strictly necessary to load the full model here -- but it does give us better type inference and
            // keeps PHPstan happy
            ->get()
            // Key by the slug for faster lookups when we start searching for a unique slug
            ->keyBy(fn (Recipe $recipe) => $recipe->slug);

        if (! $existingSlugs->has($slug)) {
            return $slug;
        }

        // Our slugs should follow an incrementing convention that looks like ['slug', 'slug-1', 'slug-2']. Because of
        // this, we should be able to take the length of our existing slug list and try to use that as our next
        // increment.
        $increment = $existingSlugs->count();

        // Best case scenario, we won't even have to enter this loop. But, in case our slugs become unordered (e.g.
        // recipe records get deleted), lets loop and increment until we find a unique slug
        while ($existingSlugs->has($this->getSlugWithIncrement($slug, $increment))) {
            $increment++;
        }

        return $this->getSlugWithIncrement($slug, $increment);
    }

    /**
     * Helper method to ensure there is a single location where we're generating a new slug that has an incremented
     * value appended to it.
     */
    protected function getSlugWithIncrement(string $slug, int $increment): string
    {
        return $slug.'-'.$increment;
    }
}
