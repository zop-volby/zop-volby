<div class="text-center">
    <div class="row">
        <div class="col text-center">
            <h2>Volební lístky</h2>
        </div>
    </div>

    <input type="hidden" name="voter_code" id="voter_code" value="{{$model->voter_code}}">
    <input type="hidden" name="secret_token" id="secret_token" value="{{$model->secret_token}}">

    <div class="row mt-4">
        <div class="col text-center">
            <p>
                Na jednotlivých volebních lístcích vyberte vaše kandidáty.
                Můžete vybírat až do maximálního počtu kandátů, jak je uvedeno v záhlaví lístku.
                Na závěr svoji volbu potvrďte tlačítkem "Odeslat".
            </p>
        </div>
    </div>

    <div class="accordion mt-4" id="electionLists">
    @foreach ($model->getLists() as $list)
        <div class="accordion-item voting-list" data-list="{{ $list->id }}" data-maxvotes="{{ $list->max_votes }}">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $list->id }}" aria-expanded="true" aria-controls="collapse{{ $list->id }}">
                    {{ $list->name }} 
                    <span class="ms-2 badge bg-primary" id="badge_{{ $list->id }}"><span id="votes_{{ $list->id }}">0</span> / {{ $list->max_votes }}</span>
                </button>
            </h2>
            <input type="hidden" name="list_{{ $list->id }}" id="list_{{ $list->id }}" value="">
            <div id="collapse{{ $list->id }}" class="accordion-collapse collapse show" data-bs-parent="#electionList">
                <div class="accordion-body">
                    <p>{{ $list->description }}</p>
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
                                    <i id="check_{{ $list->id }}_{{ $nominee->id }}" class="bi bi-square fs-2"></i>                                    
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <div class="text-end mt-3">
        <!-- <x-secondary-button type="submit" value="draft">Uložit rozpracované</x-secondary-button> -->
        <x-primary-button type="button" data-bs-toggle="modal" data-bs-target="#confirmVoting">
            Odeslat
            <i class="bi bi-arrow-right-circle-fill"></i>
        </x-primary-button>
    </div>

    <div class="modal fade" id="confirmVoting" tabindex="-1" aria-labelledby="confirmVotingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmVotingLabel">Opravdu chcete odeslat svůj hlas?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Po odeslání vyplněného hlasovacího lístku nebude možné svůj hlas změnit.
                    Vaše elektronická volba bude zaznamenána a zpracována.
                    Váš kód voliče bude zneplatněn pro prezenční hlasování.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                    <button type="submit" class="btn btn-primary" value="save">Odeslat</button>
                </div>
            </div>
        </div>
    </div>

</div>
