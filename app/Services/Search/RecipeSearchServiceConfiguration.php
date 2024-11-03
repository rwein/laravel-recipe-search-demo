<?php

namespace App\Services\Search;

class RecipeSearchServiceConfiguration
{
    public function __construct(
        public ?string $email = null,
        public ?string $keyword = null,
        public ?string $ingredient = null
    ) {}
}
