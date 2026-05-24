@extends('layouts.hms')
@section('content')
<h3>Appointment Details</h3><div class="card"><div class="card-body"><p><b>Doctor:</b> {{ $appointment->doctor->name }}</p><p><b>Patient:</b> {{ $appointment->patient->name }}</p><p><b>Date:</b> {{ $appointment->appointment_date }}</p><p><b>Time:</b> {{ $appointment->appointment_time }}</p><p><b>Status:</b> {{ ucfirst($appointment->status) }}</p><p><b>Problem:</b> {{ $appointment->problem }}</p><a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a></div></div>
@endsection
