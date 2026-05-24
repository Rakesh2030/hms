@extends('layouts.hms')
@section('content')
<h3>Doctor Details</h3>
<div class="card"><div class="card-body">
<p><b>Name:</b> {{ $doctor->name }}</p><p><b>Email:</b> {{ $doctor->email }}</p><p><b>Phone:</b> {{ $doctor->phone }}</p>
<p><b>Specialization:</b> {{ $doctor->specialization }}</p><p><b>Qualification:</b> {{ $doctor->qualification }}</p><p><b>Address:</b> {{ $doctor->address }}</p>
<a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
</div></div>
@endsection
