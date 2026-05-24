@extends('layouts.hms')
@section('content')
<h3>Edit Prescription</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('prescriptions.update',$prescription) }}">@method('PUT') --}}
<form class="api-form edit-api-form" data-url="/api/prescriptions/{{ $prescription->id }}" data-method="POST" data-fetch-url="/api/prescriptions/{{ $prescription->id }}" data-redirect="{{ route('prescriptions.index') }}">@csrf <input type="hidden" name="_method" value="PUT"> @include('prescriptions.form')<button type="submit" class="btn btn-primary">Update</button> <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
