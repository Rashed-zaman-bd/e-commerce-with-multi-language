<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with('brand')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Category fond',
            'data' => $category
        ]);
    }



    public function show($id)
    {
        $category = Category::with('brand')->find($id);

        if(!$category){
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Category found',
            'data' => $category
        ]);
    }



    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            'category_name' => 'required|string|max:255',
       ]);

       if ($validator->fails()){
        return response()->json([
            'status' => false,
            'message' => 'Validation failed'
        ]);
       }

       $data = $request->only(['brand_id', 'category_name']);

       $category = Category::create($data);

       return response()->json([
        'status' => true,
        'message' => 'Category create successfully',
        'data' => $category
       ]);
    }



    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category){
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
            ], 404);
        }

        $validetor = Validator::make($request->all(), [
            'brand_id' => 'required',
            'category_name' => 'required',
        ]);

        if($validetor->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validetor->errors()
            ]);
        }

        $category->brand_id = $request-> brand_id;
        $category->category_name = $request->category_name;

        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category update successfully',
            'data' => $category
        ]);

        
    }



    public function destroy($id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category delete successfully'
        ]);
    }


}
