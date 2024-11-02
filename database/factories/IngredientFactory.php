<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    // A generated list of available ingredients
    public static array $ingredients = ['Adzuki Beans', 'Agave Nectar', 'Allspice', 'Almond Flour', 'Almond Milk',
        'Almonds', 'Anchovy', 'Anise', 'Apple', 'Apple Cider Vinegar', 'Apple Juice', 'Apricot', 'Arborio Rice',
        'Artichoke', 'Asparagus', 'Avocado', 'Bacon', 'Baking Powder', 'Baking Soda', 'Balsamic Vinegar', 'Banana',
        'Barbecue Sauce', 'Barley', 'Basil', 'Bay Leaf', 'Bay Leaves', 'Beef', 'Beetroot', 'Bell Pepper',
        'Black Beans', 'Black Pepper', 'Blackberry', 'Blueberry', 'Bouillon', 'Brazil Nuts', 'Breadcrumbs', 'Brie',
        'Broccoli', 'Brown Rice', 'Brown Sugar', 'Brussels Sprouts', 'Bulgar', 'Butter', 'Buttermilk', 'Cajun Spice',
        'Cane Sugar', 'Canola Oil', 'Cantaloupe', 'Capers', 'Cardamom', 'Carrot', 'Cashews', 'Cauliflower',
        'Cayenne Pepper', 'Celery', 'Cheddar', 'Cheese', 'Cherry', 'Chervil', 'Chia Seeds', 'Chicken', 'Chickpeas',
        'Chili Flakes', 'Chili Pepper', 'Chili Powder', 'Chinese Five Spice', 'Chipotle Powder', 'Chives',
        'Chocolate Chips', 'Cilantro', 'Cinnamon', 'Clams', 'Clementine', 'Cloves', 'Cocoa Powder', 'Coconut Flour',
        'Coconut Milk', 'Coconut Oil', 'Coconut Sugar', 'Coconut Water', 'Cod', 'Coriander', 'Corn', 'Corn Syrup',
        'Cornmeal', 'Cornstarch', 'Cottage Cheese', 'Couscous', 'Crab', 'Cranberry', 'Cranberry Juice', 'Cream',
        'Cream Cheese', 'Cream of Tartar', 'Cucumber', 'Cumin', 'Curry Powder', 'Dark Chocolate', 'Dijon Mustard',
        'Dill', 'Dragonfruit', 'Duck', 'Duck Fat', 'Edamame', 'Egg White', 'Egg Yolk', 'Eggplant', 'Eggs', 'Farro',
        'Fennel Seeds', 'Fenugreek', 'Feta', 'Fig', 'Fish', 'Fish Sauce', 'Flaxseeds', 'Flour', 'Fusilli',
        'Garam Masala', 'Garlic', 'Gelatin', 'Ghee', 'Ginger', 'Goat Cheese', 'Gouda', 'Grapes', 'Green Beans',
        'Ground Cardamom', 'Guacamole', 'Guava', 'Haddock', 'Ham', 'Hazelnuts', 'Hemp Seeds', 'Hoisin Sauce',
        'Honey', 'Horseradish', 'Hot Sauce', 'Hummus', 'Kale', 'Ketchup', 'Kidney Beans', 'Kiwi', 'Lamb', 'Lard',
        'Lasagna Noodles', 'Lavender', 'Leek', 'Lemon', 'Lemongrass', 'Lentils', 'Lettuce', 'Lime', 'Lobster',
        'Lychee', 'Macadamia Nuts', 'Macaroni', 'Mace', 'Mango', 'Maple Syrup', 'Marjoram', 'Mayonnaise', 'Milk',
        'Milk Powder', 'Millet', 'Mint', 'Miso Paste', 'Molasses', 'Mozzarella', 'Mushroom', 'Mussels', 'Mustard',
        'Mustard Seeds', 'Navy Beans', 'Nutmeg', 'Oats', 'Octopus', 'Olive Oil', 'Olives', 'Onion', 'Orange',
        'Orange Juice', 'Oregano', 'Orzo', 'Oyster Sauce', 'Oysters', 'Papaya', 'Paprika', 'Parmesan', 'Parsley',
        'Parsnip', 'Passionfruit', 'Pasta', 'Peach', 'Peanut Butter', 'Peanut Oil', 'Pear', 'Peas', 'Pecans',
        'Pectin', 'Penne', 'Pepper', 'Pesto', 'Pickles', 'Pine Nuts', 'Pineapple', 'Pinto Beans', 'Pistachios',
        'Plum', 'Polenta', 'Pomegranate', 'Poppy Seeds', 'Pork', 'Potato', 'Powdered Sugar', 'Pumpkin',
        'Pumpkin Seeds', 'Quail', 'Quinoa', 'Radish', 'Raspberry', 'Red Wine Vinegar', 'Relish', 'Rice',
        'Rice Vinegar', 'Ricotta', 'Rosemary', 'Saffron', 'Sage', 'Salmon', 'Salsa', 'Salt', 'Sardines', 'Sausage',
        'Scallops', 'Sesame Oil', 'Sesame Seeds', 'Sherry Vinegar', 'Shrimp', 'Smoked Paprika', 'Sorrel', 'Sour Cream',
        'Soy Milk', 'Soy Sauce', 'Spaghetti', 'Sparkling Water', 'Spinach', 'Squash', 'Squid', 'Sriracha',
        'Star Anise', 'Stevia', 'Stock Cubes', 'Strawberry', 'Sugar', 'Sumac', 'Sun-Dried Tomatoes', 'Sunflower Oil',
        'Sunflower Seeds', 'Sweet Potato', 'Tabasco', 'Tahini', 'Tangerine', 'Tarragon', 'Tartar Sauce',
        'Teriyaki Sauce', 'Thyme', 'Tomato', 'Tomato Paste', 'Tomato Sauce', 'Trout', 'Tuna', 'Turkey', 'Turmeric',
        'Turnip', 'Vanilla', 'Vegetable Oil', 'Venison', 'Vinegar', 'Walnuts', 'Watermelon', 'Whipping Cream',
        'White Chocolate', 'White Pepper', 'White Rice', 'White Wine Vinegar', 'Worcestershire Sauce', 'Yeast',
        'Yogurt', 'Za’atar', 'Zucchini'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(self::$ingredients),
        ];
    }
}
