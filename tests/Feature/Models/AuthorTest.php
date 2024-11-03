<?php

namespace Tests\Feature\Models;

use App\Models\Author;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see Author
 */
class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test just to ensure we can create a new author via a factory.
     */
    public function test_an_author_can_be_created(): void
    {
        $author = Author::factory()->create();

        $this->assertDatabaseHas(Author::class, ['id' => $author->id]);
    }

    /**
     * Test our recipes() relationship on the model
     */
    public function test_an_author_has_many_recipes(): void
    {
        $author = Author::factory()->create();
        $recipes = Recipe::factory()->count(3)->create(['author_id' => $author->id]);

        $this->assertEquals(
            $author->recipes()->pluck('id')->toArray(),
            $recipes->pluck('id')->toArray()
        );
    }
}
