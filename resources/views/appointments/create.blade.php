@extends('layouts.hms')
@section('content')
<h3>Add Appointment</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('appointments.store') }}"> --}}
<form class="api-form" data-url="/api/appointments" data-method="POST" data-redirect="{{ route('appointments.index') }}">@csrf @include('appointments.form')<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
