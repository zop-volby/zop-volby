<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Kandidátní listina') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('lists.store', []) }}">
        @csrf
        @method('POST')
        @include('lists.form')
    </form>
</x-app-layout>
