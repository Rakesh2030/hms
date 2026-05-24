@extends('layouts.hms')
@section('content')
<h3>Edit Doctor</h3>
<div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('doctors.update',$doctor) }}">@method('PUT') --}}
<form class="api-form edit-api-form" data-url="/api/doctors/{{ $doctor->id }}" data-method="POST" data-fetch-url="/api/doctors/{{ $doctor->id }}" data-redirect="{{ route('doctors.index') }}">@csrf
<input type="hidden" name="_method" value="PUT">
@include('doctors.form')
<button type="submit" class="btn btn-primary">Update</button> <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
</form></div></div>
@endsection
