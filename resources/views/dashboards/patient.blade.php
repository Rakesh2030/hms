@extends('layouts.hms')

@section('content')
<h3>Patient Dashboard</h3>
<div class="card mt-3">
    <div class="card-body">
        <h5>My Appointments</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr><th>Doctor</th><th>Date</th><th>Status</th></tr>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <h5>My Bills</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr><th>Date</th><th>Amount</th><th>Status</th></tr>
                @foreach($billings as $billing)
                    <tr>
                        <td>{{ $billing->billing_date }}</td>
                        <td>{{ $billing->amount }}</td>
                        <td>{{ ucfirst($billing->payment_status) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
