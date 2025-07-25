<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeIngredient>
 */
class RecipeIngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'recipe_id' => Recipe::inRandomOrder()->first()->id,
            'ingredient_id' => Ingredient::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 500) . 'g',
        ];
    }
}
