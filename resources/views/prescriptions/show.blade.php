@extends('layouts.hms')
@section('content')
<h3>Prescription Details</h3><div class="card"><div class="card-body"><p><b>Doctor:</b> {{ $prescription->doctor->name }}</p><p><b>Patient:</b> {{ $prescription->patient->name }}</p><p><b>Date:</b> {{ $prescription->prescription_date }}</p><p><b>Medicines:</b><br>{{ $prescription->medicines }}</p><p><b>Notes:</b><br>{{ $prescription->notes }}</p><a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Back</a></div></div>
@endsection
