<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Volby') }}
        </h2>
    </x-slot>

    <div>
        <x-input-label for="name" :value="__('Jméno')" />
        <x-text-input id="name" name="name" type="text" disabled value="{{$model->name}}"/>
    </div>

    <div>
        <x-input-label for="start_at" :value="__('Začátek')" />
        <x-text-input id="start_at" name="start_at" type="datetime-local" disabled value="{{$model->start_at}}"/>
    </div>

    <div>
        <x-input-label for="phase" :value="__('Aktuální fáze')" />
        <x-text-input id="phase" name="phase" type="text" disabled value="{{__('election.phase.' . $model->phase)}}"/>
    </div>

</x-app-layout>
