<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'User found',
            'data' => $users
        ]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'user_type' => 'nullable|string',
            'mobile' => 'required|numeric|digits:11|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation fail',
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->only(['name', 'mobile', 'email', 'user_type']);
        $data['password'] = Hash::make($request->password);

        if($request->hasFile('profile_image')){
            $data['profile_image'] = $request->file('profile_image')->store('profileImage', 'public');
        }

        $user = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Create Successfully',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        }

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid mobile or password'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
}
