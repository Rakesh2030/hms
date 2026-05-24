@extends('layouts.hms')
@section('content')
<h3>Add Room</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('rooms.store') }}"> --}}
<form class="api-form" data-url="/api/rooms" data-method="POST" data-redirect="{{ route('rooms.index') }}">@csrf @include('rooms.form')<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
