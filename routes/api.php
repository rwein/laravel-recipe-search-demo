<?php

use App\Http\Controllers\Api\RecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/recipes', [RecipeController::class, 'index'])->name('api.recipes.index');
Route::get('/recipes/{recipe:slug}', [RecipeController::class, 'get'])->name('api.recipes.get');
