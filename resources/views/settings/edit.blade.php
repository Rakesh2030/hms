@extends('layouts.hms')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3">
    <h3 class="mb-0">Settings</h3>
</div>

<div class="card">
    <div class="card-body">
        {{-- Old normal CRUD form submit --}}
        {{-- <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data"> --}}
        <form class="api-form" data-url="/api/settings" data-method="POST" data-redirect="{{ route('settings.edit') }}" enctype="multipart/form-data">
            @csrf
            {{-- Old normal CRUD method spoofing --}}
            {{-- @method('PUT') --}}

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name ?? 'Hospital Management System') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Footer Text</label>
                    <input type="text" name="footer_text" class="form-control" value="{{ old('footer_text', $setting->footer_text ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control">
                    @if(! empty($setting->logo))
                        <img src="{{ asset($setting->logo) }}" alt="Logo" class="settings-preview mt-2">
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Favicon</label>
                    <input type="file" name="favicon" class="form-control">
                    @if(! empty($setting->favicon))
                        <img src="{{ asset($setting->favicon) }}" alt="Favicon" class="settings-preview mt-2">
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>
@endsection
