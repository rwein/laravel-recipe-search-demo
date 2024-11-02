<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\AuthorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Author whereUpdatedAt($value)
 *
 * @property string $email
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Author whereEmail($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Recipe> $recipes
 * @property-read int|null $recipes_count
 *
 * @mixin \Eloquent
 */
class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;

    /**
     * @return HasMany<Recipe, $this>
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }
}
