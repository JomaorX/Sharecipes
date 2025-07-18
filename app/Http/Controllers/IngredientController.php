<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Exception;

class IngredientController extends Controller
{
    public function index(){
        $ingredients = Ingredient::all();

        return response()->json($ingredients);
    }



    public function create(Request $request){
        try {
            $request->validate([
                'name' => 'required|string',
            ]);

            $ingredient = new Ingredient();
            $ingredient->name = $request->input('name');
            $ingredient->save();

            return response()->json([
                'message' => 'Ingrediente creado',
                'data' => $ingredient
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id){
        $ingredient = Ingredient::find($id);

        if(!$ingredient){
            return response()->json(['error'=>'Ingrediente no encontrado'], 404);
        } else{
            $ingredient->delete();
            return response()->json(['message'=>'Ingrediente eliminado', 'data'=>$ingredient], 200);
        }
    }

}
