<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeImageController;
use App\Http\Controllers\RecipeStepController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AuthController;

//Publicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/{id}', [RecipeController::class, 'getRecipe']);
Route::get('/ingredients', [IngredientController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/recipes/{id}/images', [RecipeImageController::class, 'index']);
Route::get('/recipes/{id}/steps', [RecipeStepController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    // Recipes
    Route::post('/recipes', [RecipeController::class, 'create']);
    Route::patch('/recipes/{id}', [RecipeController::class, 'upload']);
    Route::delete('/recipes/{id}', [RecipeController::class, 'destroy']);

    // Ingredients
    Route::post('/ingredients', [IngredientController::class, 'create']);
    Route::delete('/ingredients/{id}', [IngredientController::class, 'destroy']);

    // Categories
    Route::post('/categories', [CategoryController::class, 'create']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // RecipeImages
    Route::post('/recipes/{id}/images', [RecipeImageController::class, 'create']);
    Route::delete('/recipeImages/{id}', [RecipeImageController::class, 'destroy']);

    // RecipeSteps
    Route::post('/recipes/{id}/steps', [RecipeStepController::class, 'create']);
    Route::delete('/recipeSteps/{id}', [RecipeStepController::class, 'destroy']);

    // Favorites
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'create']);
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);

    // Auth
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Tambien se podria usar ruta ruta el middleware por ejemplo
// Route::middleware('auth:sanctum')->get('/favorites', [FavoriteController::class, 'index']);
// Route::middleware('auth:sanctum')->post('/favorites', [FavoriteController::class, 'create']);
// Route::middleware('auth:sanctum')->delete('/favorites/{id}', [FavoriteController::class, 'destroy']);