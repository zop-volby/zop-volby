<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ $model->election_name() }}: {{ __('Výsledky voleb') }}
        </h2>
    </x-slot>

    <div class="row mb-2">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-search-input id="search-bar"></x-search-input>
                <x-primary-link target="_blank" :href="route('voters.download')">{{ __('Stáhnout výsledky') }}</x-primary-link>
            </nav>
        </div>
    </div>

    <div id="search-table" class="table-responsive">
        <table class="table">
            @foreach($model->lists() as $list)
                <tr><th colspan="2">{{ $list->list_name(); }}</th></tr>
                @foreach ($list->nominees() as $nominee)
                    <tr>
                        <td>
                            {{ $nominee->name }}
                        </td>
                        <td>{{ $nominee->votes }}</td>
                    </tr> 
                @endforeach
            @endforeach
        </table>
    </div>
</x-app-layout>
