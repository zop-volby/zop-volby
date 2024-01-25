<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div>
        <p>
            {{ __("Aktualizujte si jméno a emailovou adresu.") }}
        </p>

        @if (session('status') === 'profile-updated')
            <x-alert-success>{{ __('Profil aktualizován.') }}</x-alert-success>
        @endif

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Jméno')" />
                <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-primary-button>{{ __('Uložit') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
