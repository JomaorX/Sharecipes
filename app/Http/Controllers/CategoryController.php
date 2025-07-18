<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
        public function index(){
        $categories = Category::all();

        return response()->json($categories);
    }



    public function create(Request $request){
        try {
            $request->validate([
                'name' => 'required|string',
            ]);

            $category = new Category();
            $category->name = $request->input('name');
            $category->save();

            return response()->json([
                'message' => 'Categoria creada',
                'data' => $category
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id){
        $category = Category::find($id);

        if(!$category){
            return response()->json(['error'=>'Categoria no encontrada'], 404);
        } else{
            $category->delete();
            return response()->json(['message'=>'Categoria eliminada', 'data'=>$category], 200);
        }
    }
}
