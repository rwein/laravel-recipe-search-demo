<?php

namespace App\Models;

use App\Events\RecipeCreatingEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Recipe model. Has a name and description. Belongs to an author. Has many ingredients (through a pivot). Has many
 * steps.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $author_id
 *
 * @method static \Database\Factories\RecipeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe whereUpdatedAt($value)
 *
 * @property-read \App\Models\Author|null $author
 * @property-read \App\Models\IngredientRecipe|null $pivot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ingredient> $ingredients
 * @property-read int|null $ingredients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Step> $steps
 * @property-read int|null $steps_count
 *
 * @mixin \Eloquent
 */
class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        // Generates a slug automatically when the model is inserted into the DB for the first time. Could also use
        // a model observer instead of this. I tend to slightly prefer the loose coupling using $dispatchesEvents
        // affords, it can be very nice to have a single model observer that is a "manisfest" or sorts for what happens
        // automatically during a model's lifecycle.
        'creating' => RecipeCreatingEvent::class,
    ];

    /**
     * @return BelongsTo<Author, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return HasMany<Step, $this>
     */
    public function steps(): HasMany
    {
        return $this->hasMany(Step::class)->orderBy('order');
    }

    /**
     * @return BelongsToMany<Ingredient, $this, IngredientRecipe>
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)
            ->using(IngredientRecipe::class)
            ->withPivot(['unit', 'amount']);
    }
}
