<x-guest-layout>
    <div class="row">
        <div class="col text-center">
            <h1>{{ Election::find(1)->name }}</h1>
        </div>
    </div>
    @if (session('status') !== null)
        <x-alert-danger>{{ session('status') }}</x-alert-danger>
    @endif
    <div class="row mt-4">
        <div class="col text-center">
            <p>Kód voliče: <b>{{$model->voter_code}}</b></p>
            <p>Váš hlas byl úspěšně odeslán.</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col text-center">
            <x-primary-link href="{{ route('welcome') }}">Zpět na přihlášení</x-primary-link>
        </div>
    </div>
</x-guest-layout>