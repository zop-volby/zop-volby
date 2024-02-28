<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ŽOP Volby</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="">
        <div class="">
            <div class="navbar navbar-expand-sm bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('img/icon.jpg') }}" width="20" height="24" alt="ZuSa" class="d-inline-block align-text-top">
                        {{ Election::find(1)->name }}
                    </a>
                </div>
            </div>

            <div class="container">
                <div class="row mt-4">
                    <div class="col">
                        <img src="{{ asset('img/banner.jpg') }}" class="w-100 img-fluid rounded" alt="Welcome to the cloud">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col text-center">
                        <h1>{{ Election::find(1)->name }}</h1>
                        <p>Vítejte ve volební aplikaci Židovské obce v Praze.</p>
                    </div>
                </div>
                @can('preparation')
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p>Nebližší volby budou: <b>{{ Election::find(1)->get_datetime() }}</b></p>
                        </div>
                    </div>
                @endcan
                @can('digital-voting')
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p>Digitální hlasování je otevřeno. Nejprve se přihlaste.</p>
                            <p><x-primary-link href="{{ route('voting.index') }}">Přihlásit jako volič</x-primary-link></p>
                        </div>
                    </div>
                @endcan
                <div class="row mt-4">
                    <div class="col text-end">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
