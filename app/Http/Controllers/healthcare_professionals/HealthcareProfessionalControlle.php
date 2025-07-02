<?php

namespace App\Http\Controllers\healthcare_professionals;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\HealthcareProfessional;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HealthcareProfessionalControlle extends Controller
{
    ## 1. Add validation for null post
    ## 2. Healthcare Professional register (Insetr data to db)
    
    ## Healthcare Professional Registration
    public function register(Request $request) : JsonResponse {
        try {
            $data = Validator::make($request->all(), [
                'name'    => ['required'],
                'email'    => ['required', 'email', 'unique:healthcare_professionals,email'],
                'password' => ['required'],
                'specialty' => ['required'],
            ]);

            if ($data->fails()) {
                return response()->json([
                    'status'  => false,
                    'errors'  => $data->errors()
                ], 422);
            }
            HealthcareProfessional::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'specialty' => $request->specialty,
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
    ## 2. Make Healthcare Professional auth
    ## 3. generate toke is success login
    
    ## Healthcare Professional login
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
            $user = HealthcareProfessional::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401);
            }

            $token = $user->createToken('healthcare_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
            ], 200);
        }catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
            ], 500);
        }
    }

    ## check avalablity of health care professional
    public function available_healthcare_professionals(Request $request): JsonResponse{
        try {
            $data = Validator::make($request->all(), [
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
            ]);

            if ($data->fails()) {
                return response()->json([
                    'status'  => false,
                    'errors'  => $data->errors()
                ], 422);
            }

            $start_time = $request->start_time;
            $end_time = $request->end_time;

            $available_list = HealthcareProfessional::whereDoesntHave('appointments', function ($query) use ($start_time, $end_time) {
                $query->where('appointment_start_time', '<', $start_time)
                    ->where('appointment_end_time', '>', $end_time);
            })->get();

            $available_list->each->makeHidden('email_verified_at');
            $available_list->each->makeHidden('created_at');
            $available_list->each->makeHidden('updated_at');

            return response()->json([
                'success' => true,
                'available_list' => $available_list,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
            ], 500);
        }
    }
}
