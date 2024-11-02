<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Ingredient;
use App\Models\IngredientUnit;
use App\Models\Recipe;
use App\Models\Step;
use Database\Factories\IngredientFactory;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Inserting ingredients...');

        // Bulk insert all ingredients for efficiency
        Ingredient::insert(array_map(
            callback: fn (string $ingredient) => ['name' => $ingredient],
            array: IngredientFactory::$ingredients
        ));

        // Query them back out so we can assign them during seeding
        $ingredients = Ingredient::all();
        $units = IngredientUnit::cases();

        // The process of creating a recipe (and certainly of attaching ingredients to it) should be handled through
        // a service layer. I've done it directly here, as this is the only location where it'll exist for demo
        // purposes -- but this is the kind of business logic I like to keep out of controllers/commands and more
        // contained. Sometimes, I like to create nice fluent APIs for this kind of thing (but, although they look
        // nice, I don't think they're quite as adaptable in all cases). Here's there kind of API I might try out for
        // this kind of logic:
        //
        // $recipeService->new('Recipe Name', 'Recipe description)
        //      ->setAuthor('email@test.com') // accepts record or string and firstOrCreates() it
        //      ->addIngredient('Onions', 100, 'grams') // accepts record or string and firstOrCreates() it
        //      ->addStep(1, 'Step one: . . . ')
        //      ->save();

        // We'll create 100 authors and assign a varying number of recipes to each
        $this->command->info('Creating authors...');
        $authors = Author::factory()
            ->count(100)
            ->create();

        $this->command->info('Populating recipes for each author...');
        $this->command->withProgressBar($authors->count(), function (ProgressBar $bar) use ($authors, $ingredients, $units) {
            $authors->each(function (Author $author) use ($bar, $ingredients, $units) {
                // Let's assign each author a random number of recipes
                Recipe::factory()
                    ->count(rand(1, 10))
                    ->create([
                        'author_id' => $author->id,
                    ])
                    ->each(function (Recipe $recipe) use ($ingredients, $units) {
                        // For each recipe, we'll assign a random number of ingredients
                        $ingredients->random(rand(4, 10))
                            ->each(function (Ingredient $ingredient) use ($recipe, $units) {
                                $recipe->ingredients()->attach($ingredient, [
                                    // Assign a random unit for this ingredient (e.g. tbsp or cups)
                                    'unit' => $units[rand(0, count($units) - 1)],
                                    'amount' => rand(1, 10),
                                ]);
                            });

                        // Finally, we'll assign a random number of steps
                        Step::factory(rand(4, 10))->create([
                            'recipe_id' => $recipe->id,
                        ]);
                    });
                $bar->advance();
            });
        });
    }
}
