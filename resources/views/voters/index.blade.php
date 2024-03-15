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
                @can('mail-voting')
                    <x-primary-link :href="route('voters.scan')">{{ __('Listinné hlasování') }}</x-primary-link>
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
                                <div class="flex-grow-1">
                                    {{ $voter->voter_code }}
                                    @if ($voter->voting_id) 
                                        <i class="{{ $voter->mail_voting ? 'text-danger' : 'text-success' }} bi bi-pc-display"></i>
                                    @endif
                                    @if ($voter->mail_voting)
                                        <i class="{{ $voter->voting_id ? 'text-danger' : 'text-info' }} bi bi-envelope"></i>
                                    @endif
                                </div>
                                @can('admin')
                                    @can('preparation')
                                        <x-secondary-link class="btn-sm" target="_blank" :href="route('qrcode', ['id' => $voter->voter_code])"><i class="bi bi-qr-code"></i></x-secondary-link>
                                        &nbsp;
                                    @endcan
                                    <x-secondary-link class="btn-sm" :href="route('voters.activate', ['voter' => $voter->id])"><i class="bi bi-check-square"></i></x-secondary-link>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
    </div>
</x-app-layout>
