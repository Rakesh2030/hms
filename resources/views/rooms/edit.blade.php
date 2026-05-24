@extends('layouts.hms')
@section('content')
<h3>Edit Room</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('rooms.update',$room) }}">@method('PUT') --}}
<form class="api-form edit-api-form" data-url="/api/rooms/{{ $room->id }}" data-method="POST" data-fetch-url="/api/rooms/{{ $room->id }}" data-redirect="{{ route('rooms.index') }}">@csrf <input type="hidden" name="_method" value="PUT"> @include('rooms.form')<button type="submit" class="btn btn-primary">Update</button> <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
