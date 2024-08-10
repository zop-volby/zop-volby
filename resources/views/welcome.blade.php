<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="engine" content="Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})">

        <title>ŽOP Volby</title>
        @include('layouts.telemetry')
        @include('layouts.favicons')
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
                        <img src="{{ asset('img/icon.jpg') }}" width="20" height="24" alt="ŽOP Volby" class="d-inline-block align-text-top">
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
                @if (config('voting.jwt_key') == '')
                    <div class="row mt-4">
                        <div class="col text-center">
                            <x-alert-danger>Volební aplikace není správně nakonfigurována. Kontaktujte správce systému.</x-alert-danger>
                        </div>
                    </div>
                @endif
                @can('preparation')
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p>Nebližší volby budou v následujícím termínu:
                            </br>
                            od <b>{{ Election::find(1)->get_startdate() }} {{ Election::find(1)->get_starttime() }}</b> (CET)
                            </br>
                            do <b>{{ Election::find(1)->get_enddate() }} {{ Election::find(1)->get_endtime() }}</b> (CET)
                            </p>
                        </div>
                    </div>
                @endcan
                @can('digital-voting')
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p>Digitální hlasování je otevřeno do <b>{{ Election::find(1)->get_enddate() }} {{ Election::find(1)->get_endtime() }}</b> (CET).</p>
                            <p>Nejprve se přihlaste.</p>
                            <p><x-primary-link href="{{ route('voting.index') }}">Přihlásit se jako volič</x-primary-link></p>
                        </div>
                    </div>
                @endcan
                @canany(['mail-voting', 'inperson-voting', 'result-processing', 'finished'])
                    <div class="row mt-4">
                        <div class="col text-center">
                            <p>Digitální hlasování skončilo <b>{{ Election::find(1)->get_enddate() }} {{ Election::find(1)->get_endtime() }}</b> (CET).</p>
                        </div>
                    </div>
                @endcanany
            </div>
            @include('layouts.footer')
        </div>
    </body>
</html>
