<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecipeImage;
use App\Models\Recipe;

class RecipeImageController extends Controller
{
    public function index($id){
        $images = RecipeImage::where('recipe_id', $id)->get();

        if($images->isEmpty()){
            return response()->json(['message'=>'Imagenes no encontradas o receta inexistente'], 404);
        } else {
            return response()->json($images);
        }
    }

    public function create($id, Request $request){
        $request->validate([
            'url' => 'required|string',
        ]);

        // Verificar que la receta existe
        $recipe = Recipe::find($id);
        if (!$recipe) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }

        $image = new RecipeImage();
        $image->recipe_id = $id;
        $image->url = $request->input('url');
        $image->save();

        return response()->json(['message' => 'Imagen añadida a la receta', 'data' => $image], 201);
    }

    public function destroy($id){
        $image = RecipeImage::find($id);

        if(!$image){

            return response()->json(['message'=>'No existe esa imagen'], 404);
        } else {

            $image->delete();
            return response()->json(['message'=>'Imagen eliminada', 'data' => $image], 200);
        }
    }

}
