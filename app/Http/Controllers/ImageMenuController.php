<?php

namespace App\Http\Controllers;

use App\Models\ImageMenu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageMenuController extends Controller
{
    public function index()
    {
        // Change 'letest' to 'latest'
        $imageMenu = ImageMenu::latest()->get(); 

        return response()->json([
            'status' => true,
            'message' => 'image menu found',
            'data' => $imageMenu,
        ]);
    }

    public function show($id)
    {
        $imageMenu = ImageMenu::find($id);

        if(!$imageMenu){
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data found',
            'data' => $imageMenu
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422); // Good practice to send 422 status
        }

        
        $data = $request->only(['title_en', 'title_bn']);

        
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('ImageMenu', 'public');
        }

        
        $record = ImageMenu::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Created successfully',
            'data' => $record 
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $imageMenu = ImageMenu::find($id);

        if (!$imageMenu) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title_en' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['title_en', 'title_bn']);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($imageMenu->image && Storage::disk('public')->exists($imageMenu->image)) {
                Storage::disk('public')->delete($imageMenu->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('ImageMenu', 'public');
        }

        // FIX: Call update on the Model instance ($imageMenu), not the array ($data)
        $imageMenu->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Update successful',
            'data' => $imageMenu // FIX: Use => and return the updated model
        ]);
    }


    public function destroy($id)
    {
        $imageMenu = ImageMenu::find($id);

        if (!$imageMenu) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ], 404);
        }

        // 1. Delete the image file from storage if it exists
        if ($imageMenu->image && Storage::disk('public')->exists($imageMenu->image)) {
            Storage::disk('public')->delete($imageMenu->image);
        }

        // 2. Delete the record from the database
        $imageMenu->delete();

        return response()->json([
            'status' => true,
            'message' => 'Record and image deleted successfully'
        ]);
    }
}
