<x-guest-layout>
    <div class="row">
        <div class="col text-center">
            <h1>{{ Election::find(1)->name }}</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col text-center">
            <h2>Vaše hlasování</h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col text-center">
            <div class="alert alert-warning fw-bold">
                Hlasovali jste elektronicky. 
                Proto už nevolte korespondenčně (v případě korespondenční volby budou oba způsoby hlasování zneplatněny).
                Zároveň už nebudete připuštěni k prezenčnímu hlasování.
            </div>
            <p>Váš kód voliče: <b>{{$model->voter_code}}</b></p>
            @if ($model->voting_time)
              <p>Hlasovali jste <b>{{$model->voting_time}}</b> (CET)</p>
            @endif
        </div>
    </div>

    <div class="row mt-4"><div class="col">
    @foreach ($model->getLists() as $list)
        <div class="card mb-4 results-list" data-list="{{ $list->id }}" data-maxvotes="{{ $list->max_votes }}">
            <h2 class="card-header sticky-top">
                {{ $list->name }} 
                <span class="ms-2 badge bg-primary" id="badge_{{ $list->id }}">{{ $model->votes_count($list->id) }} / {{ $list->max_votes }}</span>
            </h2>
            <div class="card-body">
                <p>{{ $list->description }}</p>
                <ul class="list-group">
                @foreach ($model->getNominees($list->id) as $nominee)
                    <li class="list-group-item text-start voting-nominee {{($model->is_checked($list->id, $nominee->id) ? "bg-success-subtle" : "")}}" data-nominee="{{ $nominee->id }}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div>
                                    <span class="nominee-name">{{ $nominee->first_name }} {{ $nominee->last_name }}</span>
                                    *{{ $nominee->year_of_birth }}
                                </div>
                                <div>
                                    {{ $nominee->biography }}
                                    @if ($nominee->link_to_page)
                                        <a target="_blank" href="{{ $nominee->link_to_page }}"><i class="bi bi-box-arrow-up-right"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="voting-button">
                                <i id="check_{{ $list->id }}_{{ $nominee->id }}" class="fs-1 bi {{($model->is_checked($list->id, $nominee->id) ? "bi-check" : "")}}"></i>                                    
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    @endforeach
    </div></div>

    <div class="row mt-4">
        <div class="col text-center">
            <p>
                <x-secondary-link href="{{ route('voting.index') }}">Zavřít</x-secondary-link>
            </p>
        </div>
    </div>

</x-guest-layout>