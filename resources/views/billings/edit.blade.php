@extends('layouts.hms')
@section('content')
<h3>Edit Bill</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('billings.update',$billing) }}">@method('PUT') --}}
<form class="api-form edit-api-form" data-url="/api/billings/{{ $billing->id }}" data-method="POST" data-fetch-url="/api/billings/{{ $billing->id }}" data-redirect="{{ route('billings.index') }}">@csrf <input type="hidden" name="_method" value="PUT"> @include('billings.form')<button type="submit" class="btn btn-primary">Update</button> <a href="{{ route('billings.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
