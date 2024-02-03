<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Kandidát') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('nominees.store', []) }}">
        @csrf
        @method('POST')
        @include('nominees.form')
    </form>
</x-app-layout>
