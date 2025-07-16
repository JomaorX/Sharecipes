<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecipeImage extends Model
{
    use HasFactory;

    public function recipes(){
        return $this->belongsTo(Recipe::class);
    }
}
