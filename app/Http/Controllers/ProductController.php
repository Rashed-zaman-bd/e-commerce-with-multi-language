<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('category', 'brand', 'user')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Product found',
            'data' => $product
        ]);
    }

    // show single product
    public function show($id)
    {
        $product = Product::with('category', 'brand', 'user')->find($id);

        if(!$product){
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Product found',
            'data' => $product
        ]);
    }

    // create product
    public function store(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'previous_price' => 'nullable|integer',
            'discount_percent' => 'nullable|integer',

            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',

            'trending' => 'boolean',
            'free_delivery' => 'boolean',
            'emi' => 'boolean',
            'exchange' => 'boolean',

            'weight' => 'nullable|string',
            'unit' => 'nullable|string',

            'stock' => 'required|integer',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'description' => 'nullable|string'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'name',
            'price',
            'previous_price',
            'discount_percent',
            'brand_id',
            'category_id',
            'trending',
            'free_delivery',
            'emi',
            'exchange',
            'weight',
            'unit',
            'stock',
            'description'
        ]);


        $data['user_id'] = Auth::id();


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('productImage', 'public');
        }

        $product = Product::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product->load('brand', 'category', 'user')
        ], 201);
    }


    public function update(Request $request, $id)
    {
        // auth check
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|integer',
            'previous_price' => 'nullable|integer',
            'discount_percent' => 'nullable|integer',

            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',

            'trending' => 'boolean',
            'free_delivery' => 'boolean',
            'emi' => 'boolean',
            'exchange' => 'boolean',

            'weight' => 'nullable|string',
            'unit' => 'nullable|string',

            'stock' => 'sometimes|integer',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'description' => 'nullable|string'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'name',
            'price',
            'previous_price',
            'discount_percent',
            'brand_id',
            'category_id',
            'trending',
            'free_delivery',
            'emi',
            'exchange',
            'weight',
            'unit',
            'stock',
            'description'
        ]);

        // ✅ image replace
        if ($request->hasFile('image')) {

            // old image delete
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('productImage', 'public');
        }

        $product->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product->load('brand', 'category', 'user')
        ]);
    }


    public function destroy($id)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // ✅ delete image
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}