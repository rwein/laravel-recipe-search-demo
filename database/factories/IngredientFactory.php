<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    // A generated list of available ingredients
    public array $ingredients = [
        // Vegetables & Fruits
        'Salt', 'Pepper', 'Olive Oil', 'Garlic', 'Onion', 'Butter', 'Flour', 'Sugar',
        'Milk', 'Eggs', 'Chicken', 'Beef', 'Tomato', 'Carrot', 'Basil', 'Thyme',
        'Rosemary', 'Oregano', 'Paprika', 'Cumin', 'Cinnamon', 'Vanilla', 'Honey',
        'Chili Powder', 'Ginger', 'Soy Sauce', 'Vinegar', 'Lemon', 'Cheese', 'Rice',
        'Pasta', 'Potato', 'Mushroom', 'Fish', 'Shrimp', 'Lettuce', 'Spinach', 'Cucumber',
        'Bell Pepper', 'Celery', 'Chili Pepper', 'Baking Soda', 'Yeast', 'Coriander',
        'Parsley', 'Mint', 'Nutmeg', 'Cloves', 'Cardamom', 'Lime', 'Coconut Milk',

        // Additional Vegetables
        'Broccoli', 'Cauliflower', 'Zucchini', 'Eggplant', 'Sweet Potato', 'Asparagus',
        'Green Beans', 'Peas', 'Corn', 'Radish', 'Beetroot', 'Brussels Sprouts', 'Kale',
        'Leek', 'Squash', 'Pumpkin', 'Avocado', 'Artichoke', 'Turnip', 'Parsnip',

        // Fruits
        'Apple', 'Banana', 'Orange', 'Strawberry', 'Blueberry', 'Raspberry', 'Grapes',
        'Pineapple', 'Mango', 'Peach', 'Pear', 'Plum', 'Cherry', 'Pomegranate', 'Kiwi',
        'Watermelon', 'Cantaloupe', 'Papaya', 'Fig', 'Guava', 'Lychee', 'Dragonfruit',
        'Passionfruit', 'Cranberry', 'Blackberry', 'Clementine', 'Tangerine', 'Apricot',

        // Dairy & Eggs
        'Cream', 'Sour Cream', 'Yogurt', 'Mozzarella', 'Cheddar', 'Parmesan', 'Feta',
        'Ricotta', 'Cottage Cheese', 'Gouda', 'Brie', 'Goat Cheese', 'Cream Cheese',
        'Butter', 'Buttermilk', 'Egg Yolk', 'Egg White', 'Whipping Cream', 'Milk Powder',

        // Meats & Seafood
        'Pork', 'Bacon', 'Ham', 'Sausage', 'Lamb', 'Duck', 'Turkey', 'Salmon', 'Tuna',
        'Trout', 'Cod', 'Haddock', 'Crab', 'Lobster', 'Clams', 'Oysters', 'Mussels',
        'Scallops', 'Octopus', 'Squid', 'Anchovy', 'Sardines', 'Venison', 'Quail',

        // Grains, Pasta, & Legumes
        'Brown Rice', 'White Rice', 'Couscous', 'Quinoa', 'Barley', 'Oats', 'Farro',
        'Bulgar', 'Millet', 'Polenta', 'Arborio Rice', 'Orzo', 'Spaghetti', 'Fusilli',
        'Penne', 'Macaroni', 'Lasagna Noodles', 'Lentils', 'Chickpeas', 'Black Beans',
        'Kidney Beans', 'Pinto Beans', 'Navy Beans', 'Adzuki Beans', 'Edamame',

        // Spices & Seasonings
        'Bay Leaf', 'Tarragon', 'Saffron', 'Turmeric', 'Cayenne Pepper', 'Black Pepper',
        'White Pepper', 'Mustard Seeds', 'Fennel Seeds', 'Fenugreek', 'Anise', 'Allspice',
        'Mace', 'Star Anise', 'Sumac', 'Za’atar', 'Garam Masala', 'Curry Powder', 'Cajun Spice',
        'Chinese Five Spice', 'Chili Flakes', 'Chipotle Powder', 'Smoked Paprika', 'Ground Cardamom',

        // Oils, Fats & Vinegars
        'Sesame Oil', 'Peanut Oil', 'Coconut Oil', 'Vegetable Oil', 'Sunflower Oil',
        'Canola Oil', 'Ghee', 'Lard', 'Duck Fat', 'Balsamic Vinegar', 'Red Wine Vinegar',
        'White Wine Vinegar', 'Apple Cider Vinegar', 'Rice Vinegar', 'Sherry Vinegar',

        // Baking & Sweeteners
        'Brown Sugar', 'Powdered Sugar', 'Maple Syrup', 'Corn Syrup', 'Molasses',
        'Agave Nectar', 'Stevia', 'Cane Sugar', 'Coconut Sugar', 'Almond Flour', 'Coconut Flour',
        'Cornmeal', 'Cornstarch', 'Baking Powder', 'Cream of Tartar', 'Gelatin', 'Pectin',
        'Cocoa Powder', 'Dark Chocolate', 'White Chocolate', 'Chocolate Chips',

        // Nuts & Seeds
        'Almonds', 'Walnuts', 'Pecans', 'Hazelnuts', 'Cashews', 'Brazil Nuts', 'Macadamia Nuts',
        'Pistachios', 'Pine Nuts', 'Sunflower Seeds', 'Pumpkin Seeds', 'Chia Seeds', 'Flaxseeds',
        'Sesame Seeds', 'Hemp Seeds', 'Poppy Seeds',

        // Herbs
        'Sage', 'Dill', 'Chervil', 'Marjoram', 'Cilantro', 'Lemongrass', 'Lavender',
        'Bay Leaves', 'Chives', 'Sorrel', 'Tarragon',

        // Condiments & Sauces
        'Ketchup', 'Mustard', 'Mayonnaise', 'Barbecue Sauce', 'Hot Sauce', 'Worcestershire Sauce',
        'Sriracha', 'Tabasco', 'Tartar Sauce', 'Hoisin Sauce', 'Oyster Sauce', 'Fish Sauce',
        'Tahini', 'Peanut Butter', 'Pesto', 'Hummus', 'Guacamole', 'Teriyaki Sauce',

        // Miscellaneous
        'Breadcrumbs', 'Capers', 'Olives', 'Pickles', 'Sun-Dried Tomatoes', 'Tomato Paste',
        'Tomato Sauce', 'Stock Cubes', 'Bouillon', 'Miso Paste', 'Salsa', 'Relish',
        'Dijon Mustard', 'Horseradish', 'Soy Milk', 'Almond Milk', 'Coconut Water', 'Sparkling Water',
        'Cranberry Juice', 'Apple Juice', 'Orange Juice',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement($this->ingredients),
        ];
    }
}
