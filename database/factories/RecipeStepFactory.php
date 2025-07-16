<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\RecipeStep;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeStep>
 */
class RecipeStepFactory extends Factory
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
            'description' => $this->faker->sentence(),
            'step_number' => $this->faker->numberBetween(1, 10),
        ];
    }
}
