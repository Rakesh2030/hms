<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BedAllotmentController;
use App\Http\Controllers\Api\BedController;
use App\Http\Controllers\Api\BillingController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Support\Facades\Route;

// Old normal CRUD routes were in routes/web.php:
// Route::resource('patients', PatientController::class);
// Route::resource('doctors', DoctorController::class);

// New API CRUD routes return JSON for AJAX.
// web + auth middleware keeps the API protected for logged-in users.
Route::middleware(['web', 'auth'])->group(function () {
    Route::middleware('role:Admin')->group(function () {
        Route::apiResource('doctors', DoctorController::class)->names('api.doctors');
        Route::apiResource('patients', PatientController::class)->names('api.patients');
        Route::apiResource('rooms', RoomController::class)->names('api.rooms');
        Route::apiResource('beds', BedController::class)->names('api.beds');
        Route::apiResource('bed-allotments', BedAllotmentController::class)->names('api.bed-allotments');
        Route::apiResource('billings', BillingController::class)->names('api.billings');

        // Settings has one common record, so simple GET and POST routes are easier for beginners.
        Route::get('settings', [SettingController::class, 'index']);
        Route::post('settings', [SettingController::class, 'update']);
    });

    Route::middleware('role:Admin|Doctor')->group(function () {
        Route::apiResource('appointments', AppointmentController::class)->names('api.appointments');
        Route::apiResource('prescriptions', PrescriptionController::class)->names('api.prescriptions');
    });
});
