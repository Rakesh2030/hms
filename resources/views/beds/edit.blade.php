@extends('layouts.hms')
@section('content')
<h3>Edit Bed</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('beds.update',$bed) }}">@method('PUT') --}}
<form class="api-form edit-api-form" data-url="/api/beds/{{ $bed->id }}" data-method="POST" data-fetch-url="/api/beds/{{ $bed->id }}" data-redirect="{{ route('beds.index') }}">@csrf <input type="hidden" name="_method" value="PUT"> @include('beds.form')<button type="submit" class="btn btn-primary">Update</button> <a href="{{ route('beds.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
