<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ $model->name }} - {{ __('Kandidáti') }} 
        </h2>
    </x-slot>

    @foreach ($model->getAllNominees() as $nominee)
        <div class="row">
            <div class="col">
                {{ $nominee->first_name }} {{ $nominee->last_name }}
            </div>
        </div>
    @endforeach

    <div>
        <x-primary-button>{{ __('Save') }}</x-primary-button>
        <x-secondary-link :href="route('lists.index')">{{ __('Cancel') }}</x-secondary-link>
    </div>

</x-app-layout>
