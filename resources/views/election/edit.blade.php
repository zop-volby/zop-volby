<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Volby') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('election.update', []) }}">
        @csrf
        @method('PUT')
        
        <div>
            <x-input-label for="name" :value="__('Jméno')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$model->name}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="start_at" :value="__('Začátek')" />
            <x-text-input id="start_at" name="start_at" type="datetime-local" step="1" required autofocus autocomplete="start_at" value="{{$model->start_at}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('start_at')" />
        </div>

        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
