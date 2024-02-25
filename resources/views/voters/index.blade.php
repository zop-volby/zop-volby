<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Voliči') }}
        </h2>
    </x-slot>

    <div class="row mb-2">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-search-input id="search-bar"></x-search-input>
                @can('preparation')
                    <x-primary-link :href="route('voters.load')">{{ __('Nahrát voliče') }}</x-primary-link>
                @endcan
            </nav>
        </div>
    </div>

    @if (session('status') !== null)
        <x-alert-success>{{ session('status') }}</x-alert-success>
    @endif

    <div class="row" id="search-row">
            @if ($voters->isEmpty())
                <div class="col">
                    <x-alert-info>{{ __('Doposud žádní voliči.') }}</x-alert-info>
                </div>
            @else
                @foreach ($voters as $voter)
                    <div class="search-item col-4 col-md-3 col-xl-2">
                        <div class="search-item-content {{$voter->is_active ? 'active' : 'inactive' }}">
                            <div class="d-flex">
                                <div class="flex-grow-1">{{ $voter->voter_code }}</div>
                                @can('admin')
                                    <x-secondary-link class="btn-sm" :href="route('voters.activate', ['voter' => $voter->id])"><i class="bi bi-check-square"></i></x-secondary-link>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
    </div>
</x-app-layout>
