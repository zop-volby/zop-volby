<x-guest-layout>
    <div class="row">
        <div class="col text-center">
            <h1>{{ Election::find(1)->name }}</h1>
        </div>
    </div>
    <div class="text-center">
    <div class="row">
        <div class="col text-center">
            <h2>Vaše hlasování</h2>
        </div>
    </div>

    <p>Hlasování proběhlo {{$model->voting_time}}</p>

    <div class="accordion mt-4" id="electionLists">
    @foreach ($model->getLists() as $list)
    <div class="accordion-item voting-list" data-list="{{ $list->id }}" data-maxvotes="{{ $list->max_votes }}">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $list->id }}" aria-expanded="true" aria-controls="collapse{{ $list->id }}">
                {{ $list->name }} 
                <span class="ms-2 badge bg-primary" id="badge_{{ $list->id }}">{{ $model->votes_count($list->id) }} / {{ $list->max_votes }}</span>
            </button>
        </h2>
        <div id="collapse{{ $list->id }}" class="accordion-collapse collapse show" data-bs-parent="#electionList">
            <div class="accordion-body">
                <ul class="list-group">
                @foreach ($model->getNominees($list->id) as $nominee)
                    <li class="list-group-item text-start voting-nominee" data-nominee="{{ $nominee->id }}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div>
                                    {{ $nominee->first_name }} {{ $nominee->last_name }} *{{ $nominee->year_of_birth }}
                                </div>
                                <div>
                                    {{ $nominee->biography }}
                                    <a target="_blank" href="{{ $nominee->link_to_page }}"><i class="bi bi-box-arrow-up-right"></i></a>
                                </div>
                            </div>
                            <div class="voting-button">
                                <i id="check_{{ $list->id }}_{{ $nominee->id }}" class="bi fs-2 {{($model->is_checked($list->id, $nominee->id) ? "bi-check-square" : "bi-square")}}"></i>                                    
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div></x-guest-layout>