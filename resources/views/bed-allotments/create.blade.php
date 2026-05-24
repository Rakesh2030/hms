@extends('layouts.hms')
@section('content')
<h3>Allot Bed</h3><div class="card"><div class="card-body">
{{-- Old normal CRUD form submit --}}
{{-- <form method="POST" action="{{ route('bed-allotments.store') }}"> --}}
<form class="api-form" data-url="/api/bed-allotments" data-method="POST" data-redirect="{{ route('bed-allotments.index') }}">@csrf @include('bed-allotments.form')<button type="submit" class="btn btn-primary">Save</button> <a href="{{ route('bed-allotments.index') }}" class="btn btn-secondary">Back</a></form></div></div>
@endsection
