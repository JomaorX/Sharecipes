<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecipeIngredient extends Model
{
    use HasFactory;
    
    public function recipe() {
    return $this->belongsTo(Recipe::class);
}

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }

}
