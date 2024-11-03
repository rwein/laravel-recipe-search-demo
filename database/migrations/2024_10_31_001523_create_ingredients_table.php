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
        // My vision for the ingredients table is that we shouldn't be duplicating ingredients unnecessarily (e.g. we
        // don't want a setup where 'potato' appears thousands of times in the table). With this, we're using the table
        // right now to essentially track whatever ingredients have been entered (firstOrCreate) and using a pivot table
        // to hold information about the amount of the ingredient to add.
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            // Fulltext for search, even though we could use a b-tree. See comment on recipe migration for more details.
            $table->string('name')->fulltext();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
