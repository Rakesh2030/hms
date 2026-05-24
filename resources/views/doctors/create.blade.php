@extends('layouts.hms')
@section('content')
<h3>Add Doctor</h3>
<div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('doctors.store') }}"> --}}
<form class="api-form" data-url="/api/doctors" data-method="POST" data-redirect="{{ route('doctors.index') }}">@csrf
@include('doctors.form')
<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
</form></div></div>
@endsection
