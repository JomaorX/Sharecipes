<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        UserTableSeeder::class,
        CategoryTableSeeder::class,
        IngredientTableSeeder::class,
        RecipeTableSeeder::class,
        RecipeImageTableSeeder::class,
        RecipeStepTableSeeder::class,
        RecipeIngredientTableSeeder::class,
        FavoriteTableSeeder::class,
    ]);

    }
}
