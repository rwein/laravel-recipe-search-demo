<?php

namespace Tests\Feature\Models;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
}
