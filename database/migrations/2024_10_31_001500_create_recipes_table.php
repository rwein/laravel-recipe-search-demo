<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            // We'll use fulltext indexes for the columns we're going to search against. Some of these we could likely
            // get away with b-tree indexes instead, but I'd probably hedge and still go with fulltext indexes in a
            // real production use-case because they'll just give us a lot of extra flexibility for how the feature
            // might organically evolve. Some considerations that I'd make though before doing that: understanding
            // performance implications of building/maintaining the indexes. And overall though, I think if we're in
            // the realm of those types of considerations, it might be time to also consider a dedicated fulltext
            // search DB and Scout. But, for now, I think fulltext indexes work.
            //
            // As an additional consideration -- I think there is something to be said about consistency and
            // predictability in a system. I think it's nice to be able to reason about a system in broad strokes.
            // In this particular case -- can we set things up so that we can give future authors the ability to make
            // the assumption that all text searching happens the same way? These little details add up over time and
            // large software projects that have a "cohesiveness" are must easier to maintain, I have found.
            $table->string('name')->fulltext();
            $table->text('description')->fulltext();
            $table->string('slug')->unique();
            $table->timestamps();

            // Foreign Keys
            $table->unsignedBigInteger('author_id')
                ->references('id')
                ->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
