<?php

namespace App\Http\Controllers\appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    ## Book an appointment
    public function book_appointment(Request $request): JsonResponse {
        try {
            $data = Validator::make($request->all(), [
                'user_id' => ['required'],
                'healthcare_professional_id' => ['required'],
                'appointment_start_time' => ['required', 'date', 'after_or_equal:now'],
                'appointment_end_time' => ['required', 'date', 'after:appointment_start_time'],
            ],
            [
                'appointment_start_time' => "Enter valid date",
                'appointment_end_time' => "Enter valid date",
            ]);

            if ($data->fails()) {
                return response()->json([
                    'status'  => false,
                    'errors'  => $data->errors()
                ], 422);
            }

            $user_id = $request->user_id;
            $healthcare_professional_id = $request->healthcare_professional_id;
            $appointment_start_time = $request->appointment_start_time;
            $appointment_end_time = $request->appointment_end_time;
            // dd($user_id, $healthcare_professional_id);

            $appointmentExists = Appointment::where('user_id', $user_id)
                ->where('status', 'booked')
                ->exists();

            if ($appointmentExists) {
                return response()->json([
                    'status'  => false,
                    'message' => "This user has already booked an appointment!",
                ], 422);
            }

            Appointment::create([
                'user_id' => $user_id,
                'healthcare_professional_id' => $healthcare_professional_id,
                'appointment_start_time' => $appointment_start_time,
                'appointment_end_time' => $appointment_end_time
            ]);

            return response()->json([
                'success' => true,
                'message' => "Appointment Booked success!",
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

    ## Users appointment list
    public function appointment_list($id): JsonResponse{
        try {
            $data = Appointment::with('healthcareProfessional')->where('user_id', $id)->get();
            $appointments = [];
            if ($data->isNotEmpty()){
                foreach ($data as $key => $value) {
                    $appointments[] = [ 
                        'id' => $value->id,
                        'healthcare_professional' => $value->healthcareProfessional->name,
                        'appointment_start_time' => $value->appointment_start_time,
                        'appointment_end_time' => $value->appointment_end_time,
                        'status' => $value->status,
                    ];
                }

                return response()->json([
                    'success' => true,
                    'appointments' => $appointments,
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'No record found.',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
            ], 500);
        }
    }

    ## cancel appointment
    public function cancel_appointment($id, $user_id): JsonResponse {
        try {
            $appointment = Appointment::where('id', $id)
            ->where('user_id', $user_id)->first();

            if (!$appointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'No record found!',
                ], 404);
            }

            $now = Carbon::now();
            $appointmentTime = Carbon::parse($appointment->appointment_start_time);
            $time_diff = $appointmentTime->lt($now->copy()->addHours(24));
            // print_r($time_diff); die;
            if ($time_diff) {
                return response()->json([
                    'success' => false,
                    'message' => 'This appointment can not be canceled!',
                ], 403);
            } else {
                $appointment->update([
                    'status' => 'cancelled',
                    'appointment_end_time'=> $now
                ]);
                return response()->json([
                    'success' => true,
                    'messgae' => "Appoientment canceled success!",
                ], 200);
            }
           
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $th->getMessage(),
                'line' => $th->getLine(),
            ], 500);
        }
    }

    ## Complete appointment by health prof.
    public function complete_appointment($id) : JsonResponse {
        try {
            Appointment::where('id', $id)
                ->update(['status' => 'completed']);
            return response()->json([
                'success' => true,
                'messgae' => "Appoientment completed success!",
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
