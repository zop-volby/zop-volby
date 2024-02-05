<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Kandidátní listina') }} {{ $model->name }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('lists.update', ['list'=>$model->id]) }}">
        @csrf
        @method('PUT')
        @include('lists.form')
    </form>
</x-app-layout>
