<?php

namespace Database\Seeders;

use App\Models\Bed;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Doctor']);
        Role::firstOrCreate(['name' => 'Patient']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@hospital.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('Admin');

        $doctorUser = User::firstOrCreate(
            ['email' => 'doctor@hospital.com'],
            [
                'name' => 'Dr. John Smith',
                'password' => Hash::make('password'),
            ]
        );
        $doctorUser->assignRole('Doctor');

        Doctor::firstOrCreate(
            ['email' => 'doctor@hospital.com'],
            [
                'user_id' => $doctorUser->id,
                'name' => 'Dr. John Smith',
                'phone' => '9876543210',
                'specialization' => 'General Medicine',
                'qualification' => 'MBBS',
                'address' => 'City Hospital',
            ]
        );

        $patientUser = User::firstOrCreate(
            ['email' => 'patient@hospital.com'],
            [
                'name' => 'Rahul Patient',
                'password' => Hash::make('password'),
            ]
        );
        $patientUser->assignRole('Patient');

        Patient::firstOrCreate(
            ['email' => 'patient@hospital.com'],
            [
                'user_id' => $patientUser->id,
                'name' => 'Rahul Patient',
                'phone' => '9999999999',
                'age' => 30,
                'gender' => 'male',
                'blood_group' => 'O+',
                'address' => 'Main Road',
            ]
        );

        $room = Room::firstOrCreate([
            'room_number' => '101',
        ], [
            'room_type' => 'General',
            'floor' => '1',
            'price_per_day' => 1000,
        ]);

        Bed::firstOrCreate([
            'room_id' => $room->id,
            'bed_number' => 'B1',
        ], [
            'status' => 'available',
        ]);
    }
}
