<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $appSettings->site_name ?? 'Hospital Management System' }}</title>
    @if(! empty($appSettings->favicon))
        <link rel="icon" href="{{ asset($appSettings->favicon) }}">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; overflow-x: hidden; }
        .sidebar { min-height: 100vh; background: #213547; }
        .sidebar a { color: #e9ecef; display: block; padding: 10px 15px; text-decoration: none; }
        .sidebar a:hover { background: #2f4b63; }
        .content { padding: 20px; }
        .site-logo { width: 34px; height: 34px; object-fit: contain; }
        .navbar-brand span { white-space: normal; }
        .settings-preview { max-width: 130px; max-height: 80px; object-fit: contain; }
        .sidebar-backdrop { display: none; }
        .table th, .table td { vertical-align: middle; white-space: nowrap; }

        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -260px;
                width: 260px;
                z-index: 1050;
                transition: left 0.3s ease;
                overflow-y: auto;
            }

            .sidebar.show { left: 0; }

            .sidebar-backdrop.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                z-index: 1040;
            }

            .content { padding: 12px; }
            .mobile-full-btn { width: 100%; }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <div class="col-md-2 sidebar p-0" id="mobileSidebar">
            <h5 class="text-white p-3 mb-0 d-flex align-items-center gap-2">
                @if(! empty($appSettings->logo))
                    <img src="{{ asset($appSettings->logo) }}" alt="Logo" class="site-logo">
                @endif
                <span>{{ $appSettings->site_name ?? 'HMS' }}</span>
            </h5>

            @role('Admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('doctors.index') }}">Doctors</a>
                <a href="{{ route('patients.index') }}">Patients</a>
                <a href="{{ route('appointments.index') }}">Appointments</a>
                <a href="{{ route('prescriptions.index') }}">Prescriptions</a>
                <a href="{{ route('rooms.index') }}">Rooms</a>
                <a href="{{ route('beds.index') }}">Beds</a>
                <a href="{{ route('bed-allotments.index') }}">Bed Allotments</a>
                <a href="{{ route('billings.index') }}">Billing</a>
                <a href="{{ route('settings.edit') }}">Settings</a>
            @endrole

            @role('Doctor')
                <a href="{{ route('doctor.dashboard') }}">Dashboard</a>
                <a href="{{ route('appointments.index') }}">Appointments</a>
                <a href="{{ route('prescriptions.index') }}">Prescriptions</a>
            @endrole

            @role('Patient')
                <a href="{{ route('patient.dashboard') }}">Dashboard</a>
            @endrole
        </div>

        <div class="col-md-10 content">
            <nav class="navbar navbar-expand-lg bg-white border mb-3">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary d-md-none me-2" type="button" id="sidebarToggle">&#9776;</button>

                    <span class="navbar-brand d-flex align-items-center gap-2">
                        @if(! empty($appSettings->logo))
                            <img src="{{ asset($appSettings->logo) }}" alt="Logo" class="site-logo">
                        @endif
                        <span>{{ $appSettings->site_name ?? 'Hospital Management System' }}</span>
                    </span>

                    <div class="ms-auto d-flex align-items-center gap-2">
                        <span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @yield('content')

            <footer class="text-center text-muted small py-3 mt-4">
                {{ $appSettings->footer_text ?? 'Hospital Management System' }}
            </footer>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Send CSRF token with AJAX requests because API CRUD is protected by login session.
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#sidebarToggle').on('click', function () {
            $('#mobileSidebar, #sidebarBackdrop').toggleClass('show');
        });

        $('#sidebarBackdrop, #mobileSidebar a').on('click', function () {
            if ($(window).width() < 768) {
                $('#mobileSidebar, #sidebarBackdrop').removeClass('show');
            }
        });

        // New API CRUD: every form with class api-form submits by AJAX.
        $('.api-form').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);
            var button = form.find('button[type="submit"]');
            var oldButtonText = button.text();
            var formData = new FormData(this);

            button.prop('disabled', true).text('Saving...');

            $.ajax({
                url: form.data('url'),
                type: form.data('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire('Success', response.message, 'success').then(function () {
                        if (form.data('redirect')) {
                            window.location.href = form.data('redirect');
                        }
                    });
                },
                error: function (xhr) {
                    showAjaxError(xhr);
                },
                complete: function () {
                    button.prop('disabled', false).text(oldButtonText);
                }
            });
        });

        // New API CRUD: edit pages fetch single record from API and fill the form.
        $('.edit-api-form').each(function () {
            var form = $(this);

            $.get(form.data('fetch-url'), function (response) {
                $.each(response.data, function (key, value) {
                    form.find('[name="' + key + '"]').val(value);
                });
            });
        });
    });

    // Show simple validation errors returned by API controller.
    function showAjaxError(xhr) {
        var message = 'Something went wrong.';

        if (xhr.responseJSON && xhr.responseJSON.message) {
            message = xhr.responseJSON.message;
        }

        if (xhr.responseJSON && xhr.responseJSON.errors) {
            message = '';
            $.each(xhr.responseJSON.errors, function (key, errors) {
                message += errors[0] + '<br>';
            });
        }

        Swal.fire('Error', message, 'error');
    }

    // Small helper used by AJAX tables.
    function textValue(value) {
        return value ? value : '';
    }
</script>
@stack('scripts')
</body>
</html>
