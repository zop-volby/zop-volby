<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ $model->name }} - {{ __('Kandidáti') }} 
        </h2>
    </x-slot>

    <form method="post" action="{{ route('lists.nominees', ['list'=>$model->id]) }}">
        @csrf
        @method('PUT')

        <div class="row nominee-list">
            <div class="col">
                <h3>{{ __('Přiřazení kandidáti') }}</h3>
                <div class="btn-group-vertical">
                    @foreach ($model->getAssignedNominees() as $nominee)
                        <input type="checkbox" class="btn-check" name="nominees[]" id="nominee-{{ $nominee->id }}" autocomplete="off" value="{{ $nominee->id }}" checked>
                        <label class="btn btn-outline-warning" for="nominee-{{ $nominee->id }}">{{ $nominee->first_name }} {{ $nominee->last_name }}</label>
                    @endforeach
                </div>
            </div>
            <div class="col">
                <h3>{{ __('Kandidáti k dispozici') }}</h3>
                <div class="btn-group-vertical">
                    @foreach ($model->getAvailableNominees() as $nominee)
                        <input type="checkbox" class="btn-check" name="nominees[]" id="nominee-{{ $nominee->id }}" autocomplete="off" value="{{ $nominee->id }}">
                        <label class="btn btn-outline-warning" for="nominee-{{ $nominee->id }}">{{ $nominee->first_name }} {{ $nominee->last_name }}</label>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            @can('preparation')
                <x-primary-button>{{ __('Save') }}</x-primary-button>   
            @endcan
            <x-secondary-link :href="route('lists.index')">{{ __('Cancel') }}</x-secondary-link>
        </div>
    </form>


</x-app-layout>
