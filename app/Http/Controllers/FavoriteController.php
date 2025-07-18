<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Recipe;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $favorites = Favorite::with('recipe')
            ->where('user_id', $user->id)
            ->get();

        return response()->json($favorites, 200);
    }

    // ⭐ Guardar receta como favorita
    public function create(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id'
        ]);

        $user = $request->user();

        // Evitar duplicados
        $exists = Favorite::where('user_id', $user->id)
            ->where('recipe_id', $request->recipe_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'La receta ya está en favoritos'], 409);
        }

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'recipe_id' => $request->recipe_id
        ]);

        return response()->json(['message' => 'Receta añadida a favoritos', 'data' => $favorite], 201);
    }

    // ⭐ Eliminar receta de favoritos
    public function destroy($id, Request $request)
    {
        $user = $request->user();

        $favorite = Favorite::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorito no encontrado'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Receta eliminada de favoritos'], 200);
    }
}
