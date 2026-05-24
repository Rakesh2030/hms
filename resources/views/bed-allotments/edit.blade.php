@extends('layouts.hms')
@section('content')
    <h3>Edit Bed Allotment</h3>
    <div class="card">
        <div class="card-body">
            {{-- Old normal CRUD form submit --}}
            {{-- <form method="POST" action="{{ route('bed-allotments.update',$bedAllotment) }}">@method('PUT') --}}
            <form class="api-form edit-api-form" data-url="/api/bed-allotments/{{ $bedAllotment->id }}" data-method="POST"
                data-fetch-url="/api/bed-allotments/{{ $bedAllotment->id }}"
                data-redirect="{{ route('bed-allotments.index') }}">@csrf <input type="hidden" name="_method" value="PUT">
                @include('bed-allotments.form')<button type="submit" class="btn btn-primary">Update</button> <a
                    href="{{ route('bed-allotments.index') }}" class="btn btn-secondary">Back</a></form>
        </div>
    </div>
@endsection
