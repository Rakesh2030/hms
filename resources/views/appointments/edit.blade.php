@extends('layouts.hms')
@section('content')
<h3>Edit Appointment</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('appointments.update',$appointment) }}">@method('PUT') --}}
<form class="api-form edit-api-form" data-url="/api/appointments/{{ $appointment->id }}" data-method="POST" data-fetch-url="/api/appointments/{{ $appointment->id }}" data-redirect="{{ route('appointments.index') }}">@csrf <input type="hidden" name="_method" value="PUT"> @include('appointments.form')<button type="submit" class="btn btn-primary">Update</button> <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
