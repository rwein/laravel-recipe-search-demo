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
        // We're going to be using a pivot table to attach ingredients to recipes. We don't want too much unnecessary
        // duplication in the ingredients table, and this is a solution to that problem.
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            // The amount of this ingredient that should go into the recipe
            $table->unsignedSmallInteger('amount');
            // The units for the amount to put into the recipe. E.g. cups, grams, ounces, etc. Allow nullable to
            // indicate when a unit doesn't make sense (e.g. "3 potatoes" doesn't need a unit).
            $table->string('unit')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->unsignedBigInteger('ingredient_id')
                ->references('id')
                ->on('ingredients')
                ->onDelete('cascade');
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
        Schema::dropIfExists('ingredient_recipe');
    }
};
