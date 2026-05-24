@extends('layouts.hms')
@section('content')
<h3>Patient Details</h3><div class="card"><div class="card-body">
<p><b>Name:</b> {{ $patient->name }}</p><p><b>Email:</b> {{ $patient->email }}</p><p><b>Phone:</b> {{ $patient->phone }}</p><p><b>Age:</b> {{ $patient->age }}</p><p><b>Gender:</b> {{ $patient->gender }}</p><p><b>Blood Group:</b> {{ $patient->blood_group }}</p><p><b>Address:</b> {{ $patient->address }}</p>
<a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a>
</div></div>
@endsection
