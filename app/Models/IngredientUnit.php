<?php

namespace App\Models;

/**
 * Enum to guard the values we'll insert into the ingredient pivot table, as well as something for the rest of the
 * system to manage those values.
 */
enum IngredientUnit: string
{
    case TSP = 'tsp';
    case TBSP = 'tbsp';
    case CUP = 'cup';
    case OZ = 'oz';
    case FL_OZ = 'fl_oz';
    case PT = 'pt';
    case QT = 'qt';
    case GAL = 'gal';
    case ML = 'ml';
    case L = 'l';
    case G = 'g';
    case KG = 'kg';
    case LB = 'lb';

    public function displayNameSingular(): string
    {
        return match ($this) {
            self::TSP => 'Teaspoon',
            self::TBSP => 'Tablespoon',
            self::CUP => 'Cup',
            self::OZ => 'Ounce',
            self::FL_OZ => 'Fluid Ounce',
            self::PT => 'Pint',
            self::QT => 'Quart',
            self::GAL => 'Gallon',
            self::ML => 'Milliliter',
            self::L => 'Liter',
            self::G => 'Gram',
            self::KG => 'Kilogram',
            self::LB => 'Pound',
        };
    }

    public function displayNamePlural(): string
    {
        return match ($this) {
            self::TSP => 'Teaspoons',
            self::TBSP => 'Tablespoons',
            self::CUP => 'Cups',
            self::OZ => 'Ounces',
            self::FL_OZ => 'Fluid Ounces',
            self::PT => 'Pints',
            self::QT => 'Quarts',
            self::GAL => 'Gallons',
            self::ML => 'Milliliters',
            self::L => 'Liters',
            self::G => 'Grams',
            self::KG => 'Kilograms',
            self::LB => 'Pounds',
        };
    }
}
