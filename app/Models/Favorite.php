<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;

    public function user() {
    return $this->belongsTo(User::class);
}

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

}
