<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Ingredient;
use App\Models\IngredientUnit;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * A seeder to insert LOTR themed recipes. The main db seeder was getting a bit boring and I wanted to create something
 * that was a bit more fun. Use with:
 *
 * ./vendor/bin/sail artisan db:seed LordOfTheRingsRecipeSeeder
 */
class LordOfTheRingsRecipeSeeder extends Seeder
{
    /**
     * A generated list of recipes from Lord of the Rings
     *
     * @var array|array[]
     */
    public array $recipes = [
        [
            'name' => 'Lembas Bread',
            'description' => 'A filling, slightly sweet Elven waybread.',
            'author' => ['email' => 'elrond@rivendell.com'],
            'ingredients' => [
                ['Flour', 2, IngredientUnit::CUP],
                ['Honey', .25, IngredientUnit::CUP],
                ['Butter', .5, IngredientUnit::CUP],
                ['Milk', .5, IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix flour, honey, and butter.'],
                ['order' => 2, 'instructions' => 'Knead the dough and bake for 20 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Seed Cakes',
            'description' => 'Small cakes made with caraway seeds, a favorite hobbit snack.',
            'author' => ['email' => 'bilbo@bagend.com'],
            'ingredients' => [
                ['Flour', 1, IngredientUnit::CUP],
                ['Butter', 1 / 2, IngredientUnit::CUP],
                ['Sugar', 1 / 2, IngredientUnit::CUP],
                ['Caraway seeds', 1, IngredientUnit::TBSP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix flour, butter, and sugar.'],
                ['order' => 2, 'instructions' => 'Add caraway seeds and bake for 25 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Roast Mutton',
            'description' => 'A hearty roast of mutton, slow-cooked with herbs, perfect for a dwarf\'s feast.',
            'author' => ['email' => 'gimli@erebor.com'],
            'ingredients' => [
                ['Mutton Leg', 1, null],
                ['Garlic Cloves', 5, null],
                ['Rosemary', 2, IngredientUnit::TBSP],
                ['Olive oil', 1 / 4, IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Rub the mutton with garlic, rosemary, and olive oil.'],
                ['order' => 2, 'instructions' => 'Roast for 2 hours at 375°F.'],
            ],
        ],
        [
            'name' => 'Beorn’s Honey Cake',
            'description' => 'A rich, sweet cake made with honey and nuts.',
            'author' => ['email' => 'beorn@carrock.com'],
            'ingredients' => [
                ['Flour', 2, IngredientUnit::CUP],
                ['Honey', 1, IngredientUnit::CUP],
                ['Butter', 1 / 2, IngredientUnit::CUP],
                ['Walnuts', 1 / 2, IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix flour, honey, butter, and nuts.'],
                ['order' => 2, 'instructions' => 'Bake for 30 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Hobbit-Style Beef and Ale Stew',
            'description' => 'A hearty stew with beef, ale, and root vegetables.',
            'author' => ['email' => 'samwise@theshire.com'],
            'ingredients' => [
                ['Beef', '500', IngredientUnit::G],
                ['Large Carrots', '2', null],
                ['Medium Potatoes', '3', null],
                ['Ale', '1', IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Brown the beef in a pot.'],
                ['order' => 2, 'instructions' => 'Add carrots, potatoes, and ale. Simmer for 2 hours.'],
            ],
        ],
        [
            'name' => 'Samwise’s Stewed Rabbit',
            'description' => 'A rustic stew made with rabbit, herbs, and vegetables.',
            'author' => ['email' => 'samwise@theshire.com'],
            'ingredients' => [
                ['Whole Rabbit', '2', null],
                ['Thyme', '1', IngredientUnit::TBSP],
                ['Large Carrots', '3', null],
                ['Medium Potatoes', '4', null],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Brown the rabbits in a pot.'],
                ['order' => 2, 'instructions' => 'Add thyme, carrots, and potatoes. Simmer for 1.5 hours.'],
            ],
        ],
        [
            'name' => 'Elven Waybread (Alternative Recipe)',
            'description' => 'A delicate version of lembas, similar to shortbread.',
            'author' => ['email' => 'galadriel@lorien.com'],
            'ingredients' => [
                ['Flour', '2', IngredientUnit::CUP],
                ['Butter', '1', IngredientUnit::CUP],
                ['Sugar', 1 / 4, IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix flour, butter, and sugar.'],
                ['order' => 2, 'instructions' => 'Roll out and bake for 15 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Mushroom Pie',
            'description' => 'A savory pie filled with mushrooms, cream, and herbs.',
            'author' => ['email' => 'frodo@bagend.com'],
            'ingredients' => [
                ['Mushrooms', '500', IngredientUnit::G],
                ['Cream', '1', IngredientUnit::CUP],
                ['Thyme', '1', IngredientUnit::TBSP],
                ['Pastry Sheet', '1', null],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Cook mushrooms with thyme and cream.'],
                ['order' => 2, 'instructions' => 'Fill pastry with mushroom mixture and bake for 30 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Dwarven Meat Pies',
            'description' => 'Hearty meat pies filled with beef and rich gravy.',
            'author' => ['email' => 'balin@erebor.com'],
            'ingredients' => [
                ['Beef', '500', IngredientUnit::G],
                ['Large Onion', '1', null],
                ['Pastry Sheet', '4', null],
                ['Gravy', '1', IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Cook beef and onions together.'],
                ['order' => 2, 'instructions' => 'Fill pastry with beef mixture and bake for 25 minutes at 375°F.'],
            ],
        ],
        [
            'name' => 'Bilbo’s Apple Tart',
            'description' => 'A simple yet delicious apple tart with a buttery crust.',
            'author' => ['email' => 'bilbo@bagend.com'],
            'ingredients' => [
                ['Large Apples', '4', null],
                ['Cinnamon', '1', IngredientUnit::TBSP],
                ['Pastry Sheet', '1', null],
                ['Sugar', 1 / 4, IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Peel and slice apples, and mix with cinnamon and sugar.'],
                ['order' => 2, 'instructions' => 'Place in pastry and bake for 30 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Tom Bombadil’s Berry Pie',
            'description' => 'A rustic pie filled with wild berries and a lattice crust.',
            'author' => ['email' => 'tom@middleearth.com'],
            'ingredients' => [
                ['Berries', '500', IngredientUnit::G],
                ['Sugar', 1 / 2, IngredientUnit::CUP],
                ['Pastry Sheets', '2', null],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix berries with sugar.'],
                ['order' => 2, 'instructions' => 'Place in pastry and cover with lattice top. Bake for 35 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Rohan Rye Bread',
            'description' => 'A dense, dark bread made from rye flour.',
            'author' => ['email' => 'eomer@rohan.com'],
            'ingredients' => [
                ['Rye flour', '2', IngredientUnit::CUP],
                ['Yeast Packet', '1', null],
                ['Water', '1', IngredientUnit::CUP],
                ['Salt', 1 / 2, IngredientUnit::TSP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix flour, yeast, water, and salt.'],
                ['order' => 2, 'instructions' => 'Knead dough and bake for 40 minutes at 375°F.'],
            ],
        ],
        [
            'name' => 'Ent-Draught (Herbal Tea)',
            'description' => 'A refreshing herbal tea made from mint and chamomile.',
            'author' => ['email' => 'treebeard@fangorn.com'],
            'ingredients' => [
                ['Mint leaves', '1', IngredientUnit::TBSP],
                ['Chamomile', '1', IngredientUnit::TBSP],
                ['Honey', '1', IngredientUnit::TSP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Steep mint and chamomile in hot water for 5 minutes.'],
                ['order' => 2, 'instructions' => 'Strain and add honey to taste.'],
            ],
        ],
        [
            'name' => 'Gondorian Herb-Crusted Fish',
            'description' => 'A baked fish dish with a flavorful herb crust.',
            'author' => ['email' => 'aragorn@gondor.com'],
            'ingredients' => [
                ['Fish fillets', '4', null],
                ['Parsley', '2', IngredientUnit::TBSP],
                ['Garlic Cloves', '2', null],
                ['Lemon', '1', null],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Season fish with parsley, garlic, and lemon.'],
                ['order' => 2, 'instructions' => 'Bake for 20 minutes at 375°F.'],
            ],
        ],
        [
            'name' => 'Shire Morning Rolls',
            'description' => 'Soft, buttery breakfast rolls perfect for a hobbit breakfast.',
            'author' => ['email' => 'pippin@theshire.com'],
            'ingredients' => [
                ['Flour', '2', IngredientUnit::CUP],
                ['Butter', 1 / 2, IngredientUnit::CUP],
                ['Yeast Packet', '1', null],
                ['Milk', 1 / 2, IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix flour, yeast, and milk. Knead into dough.'],
                ['order' => 2, 'instructions' => 'Shape into rolls and bake for 20 minutes at 350°F.'],
            ],
        ],
        [
            'name' => 'Balin’s Spiced Beef',
            'description' => 'Slow-cooked beef with warm spices like cloves and cinnamon.',
            'author' => ['email' => 'balin@dwarrowdelf.com'],
            'ingredients' => [
                ['Beef', '500', IngredientUnit::G],
                ['Cloves', '1', IngredientUnit::TSP],
                ['Cinnamon', '1', IngredientUnit::TSP],
                ['Large Onion', '1', null],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Brown beef with onions and spices.'],
                ['order' => 2, 'instructions' => 'Simmer beef for 2 hours.'],
            ],
        ],
        [
            'name' => 'Elven Salad',
            'description' => 'A fresh salad with wild greens and edible flowers.',
            'author' => ['email' => 'arwen@rivendell.com'],
            'ingredients' => [
                ['Mixed greens', '2', IngredientUnit::CUP],
                ['Edible flowers', 1 / 4, IngredientUnit::CUP],
                ['Olive oil', '2', IngredientUnit::TBSP],
                ['Lemon juice', '1', IngredientUnit::TBSP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Toss greens and flowers with olive oil and lemon juice.'],
            ],
        ],
        [
            'name' => 'Frodo’s Favorite Cheese Spread',
            'description' => 'A creamy cheese spread made with herbs and garlic.',
            'author' => ['email' => 'frodo@bagend.com'],
            'ingredients' => [
                ['Cream cheese', '1', IngredientUnit::CUP],
                ['Garlic Clove', '1', null],
                ['Chives', '1', IngredientUnit::TBSP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Mix cream cheese with garlic and chives.'],
            ],
        ],
        [
            'name' => 'Aragorn’s Wilderness Soup',
            'description' => 'A simple soup made with wild greens and mushrooms.',
            'author' => ['email' => 'aragorn@gondor.com'],
            'ingredients' => [
                ['Wild greens', '2', IngredientUnit::CUP],
                ['Mushrooms', '200', IngredientUnit::G],
                ['Large Onion', '1', null],
                ['Water', '4', IngredientUnit::CUP],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Sauté onion and mushrooms.'],
                ['order' => 2, 'instructions' => 'Add water and greens, simmer for 30 minutes.'],
            ],
        ],
        [
            'name' => 'Hobbiton Ale',
            'description' => 'A homemade ale, perfect for a hobbit feast.',
            'author' => ['email' => 'merry@theshire.com'],
            'ingredients' => [
                ['Barley', '500', IngredientUnit::G],
                ['Hops', '50', IngredientUnit::G],
                ['Water', '5', IngredientUnit::L],
                ['Yeast Packet', '1', null],
            ],
            'steps' => [
                ['order' => 1, 'instructions' => 'Boil barley and hops in water for 1 hour.'],
                ['order' => 2, 'instructions' => 'Ferment with yeast for 1 week.'],
            ],
        ],
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->withProgressBar(count($this->recipes), function (ProgressBar $bar) {
            collect($this->recipes)->each(function (array $recipeData) use ($bar) {
                $author = Author::firstOrCreate(['email' => $recipeData['author']['email']]);

                $recipe = $author->recipes()->create([
                    'name' => $recipeData['name'],
                    'description' => $recipeData['description'],
                ]);

                collect($recipeData['ingredients'])->each(function (array $ingredientData) use ($recipe) {
                    $ingredient = Ingredient::firstOrCreate(['name' => $ingredientData[0]]);
                    $recipe->ingredients()->attach(
                        $ingredient,
                        ['amount' => $ingredientData[1], 'unit' => $ingredientData[2]]
                    );
                });

                collect($recipeData['steps'])->each(function (array $stepData) use ($recipe) {
                    $recipe->steps()->create([
                        'order' => $stepData['order'],
                        'instructions' => $stepData['instructions'],
                    ]);
                });

                $bar->advance();
            });
        });
    }
}
