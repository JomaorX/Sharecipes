<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeImage extends Model
{
    public function recipes(){
        return $this->belongsTo(Recipe::class);
    }
}
