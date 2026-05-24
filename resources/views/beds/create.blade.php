@extends('layouts.hms')
@section('content')
<h3>Add Bed</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('beds.store') }}"> --}}
<form class="api-form" data-url="/api/beds" data-method="POST" data-redirect="{{ route('beds.index') }}">@csrf @include('beds.form')<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('beds.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
