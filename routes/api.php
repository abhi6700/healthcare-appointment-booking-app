<?php

use App\Http\Controllers\appointment\AppointmentController;
use App\Http\Controllers\healthcare_professionals\HealthcareProfessionalControlle;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

## User related routes
Route::post('/register', [UserController::class,'register'])->name('register'); 
Route::post('/login', [UserController::class,'login'])->name('login'); 

## Healthcare Professional related routes
Route::post('/healthcare_professionals_register', [HealthcareProfessionalControlle::class,'register'])->name('healthcare_professionals.register'); 
Route::post('/healthcare_professionals_login', [HealthcareProfessionalControlle::class,'login'])->name('healthcare_professionals.login'); 

## Appointment booking related routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/book_appointment', [AppointmentController::class,'book_appointment'])->name('book_appointment'); 
    Route::get('/appointment_list/{id}', [AppointmentController::class,'appointment_list'])->name('appointment_list'); 
    Route::put('/cancel_appointment/{id}/{user_id}', [AppointmentController::class,'cancel_appointment'])->name('cancel_appointment'); 
    Route::post('/available_healthcare_professionals', [HealthcareProfessionalControlle::class,'available_healthcare_professionals'])->name('available_healthcare_professionals'); 
});

Route::middleware(['auth:sanctum', 'auth.hp'])->group(function () {
    Route::put('/complete_appointment/{id}', [AppointmentController::class,'complete_appointment'])->name('complete_appointment');
});
