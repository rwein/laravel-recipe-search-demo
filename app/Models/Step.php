<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\StepFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step whereUpdatedAt($value)
 *
 * @property int $order
 * @property string $instructions
 * @property int $recipe_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Step whereRecipeId($value)
 *
 * @mixin \Eloquent
 */
class Step extends Model
{
    /** @use HasFactory<\Database\Factories\StepFactory> */
    use HasFactory;
}
