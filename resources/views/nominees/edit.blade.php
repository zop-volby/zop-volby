<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Kandidát') }} {{ $model->first_name }} {{ $model->last_name }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('nominees.update', ['nominee'=>$model->id]) }}">
        @csrf
        @method('PUT')
        @include('nominees.form')
    </form>
</x-app-layout>
