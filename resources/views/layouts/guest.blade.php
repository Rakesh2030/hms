<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $appSettings->site_name ?? config('app.name', 'Laravel') }}</title>
        @if(! empty($appSettings->favicon))
            <link rel="icon" href="{{ asset($appSettings->favicon) }}">
        @endif

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container-fluid px-3">
            <div class="row justify-content-center mt-4 mt-md-5">
                <div class="col-12 col-sm-10 col-md-6 col-lg-5">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-body">
                {{ $slot }}
                </div>
            </div>
                </div>
            </div>
        </div>
    </body>
</html>
