<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    public function recipes(){
        return $this->belongsTo(Recipe::class);
    }
}
