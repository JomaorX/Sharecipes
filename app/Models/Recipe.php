<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\RecipeImage;
use App\Models\RecipeStep;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{

    //protected $table = 'recipes'; //Nombre de la tabla PD: no es necesario definirlo porque laravel lo comprende, a no ser que no concuerden los nombres, es decir comprende que Recipe es el modelo de la table recipes pero si la tabla fuera recetas y el modelo recipes ya habria que aclararlo

    use HasFactory;

    // protected $fillable = ['title', 'user_id', 'category_id', 'description'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function recipeImages(){
        return $this->hasMany(RecipeImage::class);
    }

    public function recipeSteps(){
        return $this->hasMany(RecipeStep::class);
    }

    public function ingredients() {
    return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')->withPivot('quantity');
}

}
