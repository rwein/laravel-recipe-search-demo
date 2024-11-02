<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\IngredientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereUpdatedAt($value)
 *
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ingredient whereName($value)
 *
 * @mixin \Eloquent
 */
class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;
}
