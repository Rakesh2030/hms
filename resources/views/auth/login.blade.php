<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appSettings->site_name ?? 'Hospital Login' }}</title>
    @if (!empty($appSettings->favicon))
        <link rel="icon" href="{{ asset($appSettings->favicon) }}">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container-fluid px-3">
        <div class="row justify-content-center mt-4 mt-md-5">
            <div class="col-12 col-sm-10 col-md-6 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        @if (!empty($appSettings->logo))
                            <img src="{{ asset($appSettings->logo) }}" alt="Logo"
                                style="max-width: 70px; max-height: 70px; object-fit: contain;">
                        @endif
                        <h4 class="mt-2">{{ $appSettings->site_name ?? 'Hospital Management System' }}</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    required autofocus>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">

                                <label class="form-label">Captcha</label>

                                <div class="d-flex align-items-center gap-2">

                                    <span>{!! captcha_img() !!}</span>

                                    <button type="button" class="btn btn-sm btn-primary" onclick="refreshCaptcha()">

                                        Refresh

                                    </button>

                                </div>

                                <input type="text" name="captcha" class="form-control mt-2"
                                    placeholder="Enter Captcha">

                                @error('captcha')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label for="remember" class="form-check-label">Remember me</label>
                            </div>
                            <button class="btn btn-primary w-100">Login</button>
                        </form>

                        <div class="mt-3 small">
                            <div><b>Admin:</b> admin@hospital.com / password</div>
                            <div><b>Doctor:</b> doctor@hospital.com / password</div>
                            <div><b>Patient:</b> patient@hospital.com / password</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function refreshCaptcha() {
            fetch('/refresh-captcha')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.d-flex span').innerHTML = data.captcha;
                });
        }
    </script>
</body>

</html>
