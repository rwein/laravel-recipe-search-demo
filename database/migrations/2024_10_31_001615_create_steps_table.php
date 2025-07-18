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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('order');
            // Fulltext for search, even though we could use a b-tree. See comment on recipe migration for more details.
            $table->text('instructions')->fulltext();
            $table->timestamps();

            // Foreign Keys
            $table->unsignedBigInteger('recipe_id')
                ->references('id')
                ->on('recipes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
