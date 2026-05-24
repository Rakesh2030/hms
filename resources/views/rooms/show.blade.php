@extends('layouts.hms')
@section('content')
<h3>Room Details</h3><div class="card"><div class="card-body"><p><b>Room Number:</b> {{ $room->room_number }}</p><p><b>Type:</b> {{ $room->room_type }}</p><p><b>Floor:</b> {{ $room->floor }}</p><p><b>Price:</b> {{ $room->price_per_day }}</p><a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back</a></div></div>
@endsection
