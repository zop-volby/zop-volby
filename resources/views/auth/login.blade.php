<x-guest-layout>
    <div class="narrow-component">
        <img src="{{ asset('img/banner.jpg') }}" class="img-fluid rounded mb-4" alt="Welcome to the cloud">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="d-grid gap-2">
            <a class="btn btn-secondary" href="{{ route('auth.azure') }}">
                <i class="bi bi-microsoft"></i> Přihlásit se přes Microsoft
            </a>
            <a class="btn btn-secondary" href="{{ route('auth.google') }}">
                <i class="bi bi-google"></i> Přihlásit se přes Google
            </a>
        </div>
    </div>
</x-guest-layout>
