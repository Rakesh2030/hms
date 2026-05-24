@extends('layouts.hms')
@section('content')
<h3>Add Bill</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('billings.store') }}"> --}}
<form class="api-form" data-url="/api/billings" data-method="POST" data-redirect="{{ route('billings.index') }}">@csrf @include('billings.form')<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('billings.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
