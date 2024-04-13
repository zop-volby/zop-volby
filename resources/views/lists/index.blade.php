<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Kandidátní listiny') }}
        </h2>
    </x-slot>

    <div class="row mb-2">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-search-input id="search-bar"></x-search-input>
                @can('preparation')
                    <x-primary-link :href="route('lists.create')">{{ __('Nová listina') }}</x-primary-link>
                @endcan
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($model->isEmpty())
                <x-alert-info>{{ __('Doposud žádné kandidátní listiny.') }}</x-alert-info>
            @else
                <div id="search-table" class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Název') }}</th>
                                <th>{{ __('Popiska') }}</th>
                                <th>{{ __('Počet hlasů') }}</th>
                                <th>{{ __('Počet kandidátů') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->max_votes }}</td>
                                    <td>{{ $item->nominees->count() }}</td>
                                    <td class="text-end text-nowrap">
                                        @can('preparation')
                                            <x-secondary-link :href="route('lists.edit', ['list'=> $item->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                                        @endcan
                                        <x-secondary-link :href="route('lists.nominees', ['list'=> $item->id])"><i class="bi bi-card-list"></i></x-secondary-link>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
