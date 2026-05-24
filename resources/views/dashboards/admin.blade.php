@extends('layouts.hms')

@section('content')
<h3>Admin Dashboard</h3>
<div class="row g-3 mt-1">
    <div class="col-12 col-sm-6 col-lg-3"><div class="card h-100"><div class="card-body"><h6>Doctors</h6><h3>{{ $doctors }}</h3></div></div></div>
    <div class="col-12 col-sm-6 col-lg-3"><div class="card h-100"><div class="card-body"><h6>Patients</h6><h3>{{ $patients }}</h3></div></div></div>
    <div class="col-12 col-sm-6 col-lg-3"><div class="card h-100"><div class="card-body"><h6>Appointments</h6><h3>{{ $appointments }}</h3></div></div></div>
    <div class="col-12 col-sm-6 col-lg-3"><div class="card h-100"><div class="card-body"><h6>Available Beds</h6><h3>{{ $beds }}</h3></div></div></div>
</div>
<div class="card mt-3">
    <div class="card-body">
        <h5>Total Billing Amount</h5>
        <p class="fs-4 mb-0">{{ number_format($billings, 2) }}</p>
    </div>
</div>
@endsection
