@extends('layouts.hms')

@section('content')
<h3>Doctor Dashboard</h3>
<div class="card mt-3">
    <div class="card-body">
        <h5>My Appointments</h5>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <tr><th>Patient</th><th>Date</th><th>Status</th></tr>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
