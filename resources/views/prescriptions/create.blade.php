@extends('layouts.hms')
@section('content')
<h3>Add Prescription</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('prescriptions.store') }}"> --}}
<form class="api-form" data-url="/api/prescriptions" data-method="POST" data-redirect="{{ route('prescriptions.index') }}">@csrf @include('prescriptions.form')<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
