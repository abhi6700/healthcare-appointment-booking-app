<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    ## 1. Add validation for null post
    ## 2. User register (Insetr data to db)
    
    ## User Registration
    public function register(Request $request) : JsonResponse {
        try {
            $data = Validator::make($request->all(), [
                'name'    => ['required'],
                'email'    => ['required', 'email', 'unique:users,email'],
                'password' => ['required'],
            ]);

            if ($data->fails()) {
                return response()->json([
                    'status'  => false,
                    'errors'  => $data->errors()
                ], 422);
            }
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registration Success!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    ## 1. Add validation for null post
    ## 2. Make user auth
    ## 3. generate toke is success login
    
    ## User login
    public function login(Request $request): JsonResponse {
        try {
            $data = Validator::make($request->all(), [
                'email'    => ['required', 'email'],
                'password' => ['required'],
            ]);

            if ($data->fails()) {
                return response()->json([
                    'status'  => false,
                    'errors'  => $data->errors()
                ], 422);
            }
            $data = $data->validated(); 

            if (Auth::attempt($data)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'token' => $token,
                ], 200);
            }

            return response()->json([
                'success' => false,
                'error' => 'Invalid Email-ID & Password!',
            ], 401);
        }catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
            ], 500);
        }
    }
}
