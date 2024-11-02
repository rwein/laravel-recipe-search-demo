<?php

namespace App\Services;

use App\Models\Recipe;

interface RecipeSlugServiceInterface
{
    public function generate(Recipe $recipe): string;
}
