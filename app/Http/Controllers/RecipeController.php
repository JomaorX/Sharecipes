<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Excepion;

class RecipeController extends Controller
{
    public function index(){
        $recipes = Recipe::with([
            'user',
            'category',
            'ingredients',
            'recipeSteps',
            'recipeImages'
        ])->get();

        return response()->json($recipes);
    }

    public function getRecipe($id){
    $recipe = Recipe::with([
        'user',
        'category',
        'ingredients',
        'recipeSteps',
        'recipeImages'
    ])->find($id);
        echo ('hola');
    if (!$recipe) {
        return response()->json(['message' => 'Receta no encontrada'], 404);
    }

    return response()->json(['messaje'=>'chupoctero']);
}

    public function create(Request $request){
    try{
        $request->validate([
            'title' => 'required|string',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'required|string',
        ]);

        $recipe = new Recipe();
        $recipe->title = $request->input('title');
        $recipe->user_id = $request->input('user_id');
        $recipe->category_id = $request->input('category_id');
        $recipe->description = $request->input('description');
        $recipe->save();

        return response()->json(['message' => 'Receta creada', 'data' => $recipe], 201);
    } catch (Exception $e){
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function upload($id, Request $request){
    $recipe = Recipe::find($id);

    if (!$recipe) {
        return response()->json(['message' => 'Receta no encontrada'], 404);
    }

    // Validación de campos actualizables
    $request->validate([
        'title' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'category_id' => 'nullable|integer',
        'description' => 'nullable|string',
    ]);

    // Actualizar solo los campos presentes en la solicitud
    if ($request->has('title')) {
        $recipe->title = $request->input('title');
    }

    if ($request->has('user_id')) {
        $recipe->user_id = $request->input('user_id');
    }

    if ($request->has('category_id')) {
        $recipe->category_id = $request->input('category_id');
    }

    if ($request->has('description')) {
        $recipe->description = $request->input('description');
    }

    $recipe->save();
    \Log::info('Valores actualizados:', $recipe->toArray());

    return response()->json(['message' => 'Receta actualizada', 'data' => $recipe], 200);
}



    public function destroy($id){
        $recipe = Recipe::find($id);

        if(!$recipe) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        } else{
            $recipe->delete();
            return response()->json(['message' => 'Receta eliminada'], 200);
        }
    }
}
