@extends('layouts.hms')
@section('content')
    <h3>Bed Details</h3>
    <div class="card">
        <div class="card-body">
            <p><b>Bed Number:</b> {{ $bed->bed_number }}</p>
            <p><b>Room:</b> {{ $bed->room->room_number }}</p>
            <p><b>Status:</b> {{ ucfirst($bed->status) }}</p><a href="{{ route('beds.index') }}"
                class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
