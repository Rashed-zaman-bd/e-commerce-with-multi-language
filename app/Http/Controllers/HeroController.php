<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HeroController extends Controller
{
    public function index()
    {
        $hero = Hero::latest()->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Data found',
            'data' => $hero
        ]);
    }

    public function show($id)
    {
        $hero = Hero::find($id);

        if(!$hero){
            return response()->json([
                'status' => false,
                'message' => 'Data not found',

            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data found',
            'data' => $hero
        ]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'link' => 'required|string',
            'image_dec' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'image_mobile' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->only(['link']);

        if($request->hasFile('image_dec')){
            $data['image_dec'] = $request->file('image_dec')->store('HeroImage', 'public');
        }

        if($request->hasFile('image_mobile')){
            $data['image_mobile'] = $request->file('image_mobile')->store('HeroImage', 'public');
        }

        $record = Hero::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Create successfully',
            'data' => $record
        ]);
    }


    public function update(Request $request, $id)
    {
        $hero = Hero::find($id);

        if (!$hero) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'link'         => 'nullable|string',
            'image_dec'    => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'image_mobile' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $data = $request->only(['link']);

        // Desktop Image Update
        if ($request->hasFile('image_dec')) {

            // Delete old image
            if ($hero->image_dec && Storage::disk('public')->exists($hero->image_dec)) {
                Storage::disk('public')->delete($hero->image_dec);
            }

            // Upload new image
            $data['image_dec'] = $request->file('image_dec')->store('HeroImage', 'public');
        }

        // Mobile Image Update
        if ($request->hasFile('image_mobile')) {

            // Delete old image
            if ($hero->image_mobile && Storage::disk('public')->exists($hero->image_mobile)) {
                Storage::disk('public')->delete($hero->image_mobile);
            }

            // Upload new image
            $data['image_mobile'] = $request->file('image_mobile')->store('HeroImage', 'public');
        }

        $hero->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Updated successfully',
            'data'    => $hero
        ]);
    }


    public function destroy($id)
    {
        $hero = Hero::find($id);

        if (!$hero) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ], 404);
        }

        // Delete desktop image
        if ($hero->image_dec) {
            if (Storage::disk('public')->exists($hero->image_dec)) {
                Storage::disk('public')->delete($hero->image_dec);
            }
        }

        // Delete mobile image
        if ($hero->image_mobile) {
            if (Storage::disk('public')->exists($hero->image_mobile)) {
                Storage::disk('public')->delete($hero->image_mobile);
            }
        }

        // Delete database record
        $hero->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
        ]);
    }





}
