@extends('layouts.hms')
@section('content')
<h3>Bed Allotment Details</h3><div class="card"><div class="card-body"><p><b>Patient:</b> {{ $bedAllotment->patient->name }}</p><p><b>Bed:</b> {{ $bedAllotment->bed->bed_number }}</p><p><b>Room:</b> {{ $bedAllotment->bed->room->room_number }}</p><p><b>Allotment Date:</b> {{ $bedAllotment->allotment_date }}</p><p><b>Discharge Date:</b> {{ $bedAllotment->discharge_date }}</p><p><b>Status:</b> {{ ucfirst($bedAllotment->status) }}</p><a href="{{ route('bed-allotments.index') }}" class="btn btn-secondary">Back</a></div></div>
@endsection
