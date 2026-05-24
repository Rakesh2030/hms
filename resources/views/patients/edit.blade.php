@extends('layouts.hms')
@section('content')
<h3>Edit Patient</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('patients.update',$patient) }}">@method('PUT') --}}
<form class="api-form edit-api-form" data-url="/api/patients/{{ $patient->id }}" data-method="POST" data-fetch-url="/api/patients/{{ $patient->id }}" data-redirect="{{ route('patients.index') }}">@csrf <input type="hidden" name="_method" value="PUT"> @include('patients.form')<button type="submit" class="btn btn-primary">Update</button> <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
