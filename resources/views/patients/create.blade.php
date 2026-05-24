@extends('layouts.hms')
@section('content')
<h3>Add Patient</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('patients.store') }}"> --}}
<form class="api-form" data-url="/api/patients" data-method="POST" data-redirect="{{ route('patients.index') }}">@csrf @include('patients.form')<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
