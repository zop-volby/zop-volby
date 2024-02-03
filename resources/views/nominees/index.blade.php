<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Kandidáti') }}
        </h2>
    </x-slot>

    <div class="row mb-2">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-search-input id="search-bar"></x-search-input>
                <x-primary-link :href="route('nominees.create')">{{ __('Nový kandidát') }}</x-primary-link>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($model->isEmpty())
                <x-alert-info>{{ __('Doposud žádní kandidáti.') }}</x-alert-info>
            @else
                <div id="search-table" class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Jméno') }}</th>
                                <th>{{ __('Příjmení') }}</th>
                                <th>{{ __('Rok narození') }}</th>
                                <th>{{ __('Biografie') }}</th>
                                <th>{{ __('Odkaz na stránky') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->year_of_birth }}</td>
                                    <td>{{ $item->biography }}</td>
                                    <td>
                                        {{ $item->link_to_page }}
                                        <a target="_blank" href="{{ $item->link_to_page }}"><i class="bi bi-box-arrow-up-right"></i></a>
                                    </td>
                                    <td class="text-end">
                                        <x-secondary-link :href="route('nominees.edit', ['nominee'=> $item->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
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
