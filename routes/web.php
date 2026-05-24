<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BedAllotmentController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SettingController;
use App\Models\Appointment;
use App\Models\Bed;
use App\Models\Billing;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('Admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->hasRole('Doctor')) {
        return redirect()->route('doctor.dashboard');
    }

    return redirect()->route('patient.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Dashboard routes check the logged in user's role and show the correct dashboard.
    Route::get('/admin/dashboard', function () {
        // Count records for the admin dashboard cards.
        $doctors = Doctor::count();
        $patients = Patient::count();
        $appointments = Appointment::count();
        $beds = Bed::where('status', 'available')->count();
        $billings = Billing::sum('amount');

        return view('dashboards.admin', compact('doctors', 'patients', 'appointments', 'beds', 'billings'));
    })->middleware('role:Admin')->name('admin.dashboard');

    Route::get('/doctor/dashboard', function () {
        $doctor = Doctor::where('user_id', auth()->id())->first();
        $appointments = collect();

        if ($doctor) {
            $appointments = Appointment::where('doctor_id', $doctor->id)->latest()->get();
        }

        return view('dashboards.doctor', compact('doctor', 'appointments'));
    })->middleware('role:Doctor')->name('doctor.dashboard');

    Route::get('/patient/dashboard', function () {
        $patient = Patient::where('user_id', auth()->id())->first();
        $appointments = collect();
        $billings = collect();

        if ($patient) {
            $appointments = Appointment::where('patient_id', $patient->id)->latest()->get();
            $billings = Billing::where('patient_id', $patient->id)->latest()->get();
        }

        return view('dashboards.patient', compact('patient', 'appointments', 'billings'));
    })->middleware('role:Patient')->name('patient.dashboard');

    Route::middleware('role:Admin')->group(function () {
        // Old normal CRUD routes. These routes used to save/update/delete directly.
        // Route::resource('doctors', DoctorController::class);
        // Route::resource('patients', PatientController::class);
        // Route::resource('rooms', RoomController::class);
        // Route::resource('beds', BedController::class);
        // Route::resource('bed-allotments', BedAllotmentController::class);
        // Route::resource('billings', BillingController::class);

        // New API CRUD flow: web routes only open Blade pages. AJAX calls routes/api.php for data.
        Route::resource('doctors', DoctorController::class)->only(['index', 'create', 'show', 'edit']);
        Route::resource('patients', PatientController::class)->only(['index', 'create', 'show', 'edit']);
        Route::resource('rooms', RoomController::class)->only(['index', 'create', 'show', 'edit']);
        Route::resource('beds', BedController::class)->only(['index', 'create', 'show', 'edit']);
        Route::resource('bed-allotments', BedAllotmentController::class)->only(['index', 'create', 'show', 'edit']);
        Route::resource('billings', BillingController::class)->only(['index', 'create', 'show', 'edit']);
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        // Old normal settings update route.
        // Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });

    Route::middleware('role:Admin|Doctor')->group(function () {
        // Old normal CRUD routes.
        // Route::resource('appointments', AppointmentController::class);
        // Route::resource('prescriptions', PrescriptionController::class);

        // New API CRUD flow: these routes only show pages.
        Route::resource('appointments', AppointmentController::class)->only(['index', 'create', 'show', 'edit']);
        Route::resource('prescriptions', PrescriptionController::class)->only(['index', 'create', 'show', 'edit']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/refresh-captcha', function () {

    return response()->json([
        'captcha' => captcha_img()
    ]);
});

Route::get('/fix', function () {
    Artisan::call('optimize:clear');
    Artisan::call('storage:link');

    return 'fixed';
});

Route::get('/seed', function () {

    Artisan::call('db:seed', [
        '--force' => true
    ]);

    return 'Database seeded successfully';
});


require __DIR__ . '/auth.php';
