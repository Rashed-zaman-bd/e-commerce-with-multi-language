<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::with('categories')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Brand found',
            'data' => $brand
        ]);
    }

    public function show($id)
    {
        $brand = Brand::find($id);

        if (!$brand){
            return response()->json([
                'status' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Brand found',
            'data' => $brand
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required|string|max:255',
            'brand_image' => 'nullable|image|mimes:jpg,jpge,png,wepb|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->only(['brand_name']);

        if($request->hasFile('brand_image')){
            $data['brand_image'] = $request->file('brand_image')->store('brandImage', 'public');
        }

        $brand = Brand::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Brand create successfully',
            'data' => $brand
        ]);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);

        if(!$brand){
            return response()->json([
                'status' => false,
                'message' => 'Brand not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
            'brand_image' => 'nullable|image|mimes:jpg,jpge,png,webp|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        }

        $brand->brand_name = $request-> brand_name;

        if($request->hasFile('brand_image')){
            if($brand->brand_image && Storage::disk('public')->exists($brand->brand_image)){
                Storage::disk('public')->delete($brand->brand_image);
            }

            // ✅ Upload new image
            $path = $request->file('brand_image')->store('brandImage', 'public');
            $brand->brand_image = $path;
        }

        $brand->save();

        return response()->json([
            'ststus' => true,
            'message' => 'Brand update successfully',
            'data' => $brand
        ]);
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);

        if(!$brand){
            return response()->json([
                'status' => false,
                'message' => 'Brand not found',
            ], 404);
        }

        if($brand->brand_image && Storage::disk('public')->exists($brand->brand_image)){
            Storage::disk('public')->delete($brand->brand_image);
        }

        $brand->delete();

        return response()->json([
            'status' => true,
            'message' => 'Brand delete successfully',
        ]);

    }


}
