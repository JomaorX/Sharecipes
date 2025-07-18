<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecipeStep;
use App\Models\Recipe;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Exception;

class RecipeStepController extends Controller
{
    public function index($id){
        $steps = RecipeStep::where('recipe_id', $id)->get();

        if($steps->isEmpty()) return response()->json(['message'=>'Pasos no encontrados o receta inexistente'], 404);
        else return response()->json($steps, 200);
    }

    public function create($id, Request $request){

        try{
            $request->validate([
            'step_number'=>'required|integer',
            'description'=>'required|string'
        ]);

        $step = new RecipeStep();
        $recipe = Recipe::find($id);

        if(!$recipe) return response()->json(['message'=>'No existe esa receta'], 404);
        else {
            $step->recipe_id = $id;
            $step->step_number = $request->input('step_number');
            $step->description = $request->input('description');
            $step->save();

            return response()->json(['message'=> 'Paso creado', 'data'=>$step], 201);
        }
        }  catch (\Exception $e) {
            return response()->json(['error'=>$e->getMessage()], 500);
        }
        }

    public function destroy($id){
                $step = RecipeStep::find($id);

        if(!$step){

            return response()->json(['message'=>'No existe ese paso'], 404);
        } else {

            $step->delete();
            return response()->json(['message'=>'Paso eliminado', 'data' => $step], 200);
        }
    }
    
}
