<div>
    <x-input-label for="first_name" :value="__('Jméno')" />
    <x-text-input id="first_name" name="first_name" type="text" required autofocus autocomplete="first_name" value="{{$model->first_name}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
</div>

<div>
    <x-input-label for="last_name" :value="__('Příjmení')" />
    <x-text-input id="last_name" name="last_name" type="text" required autofocus autocomplete="last_name" value="{{$model->last_name}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
</div>

<div>
    <x-input-label for="year_of_birth" :value="__('Rok narození')" />
    <x-text-input id="year_of_birth" name="year_of_birth" type="number" required autofocus autocomplete="year_of_birth" value="{{$model->year_of_birth}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('year_of_birth')" />
</div>

<div>
    <x-input-label for="biography" :value="__('Krátká biografie')" />
    <x-text-input id="biography" name="biography" type="text" autofocus autocomplete="biography" value="{{$model->biography}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('biography')" />
</div>

<div>
    <x-input-label for="link_to_page" :value="__('Odkaz na stránku')" />
    <x-text-input id="link_to_page" name="link_to_page" type="text" autofocus autocomplete="link_to_page" value="{{$model->link_to_page}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('link_to_page')" />
</div>

<div>
    <x-input-label for="electionLists" :value="__('Kandiduje za listiny')" />
    <div class="form-control btn-group flex-wrap">
        @foreach($model->getAllElectionLists() as $list)
            <input type="checkbox" class="btn-check" name="electionLists[]" id="{{$list->id}}" autocomplete="off" value="{{$list->id}}" @if($model->electionLists->contains($list)) checked @endif>
            <label class="btn btn-outline-primary" for="{{$list->id}}">{{$list->name}}</label>
        @endforeach        
    </div>
    <x-input-error class="mt-2" :messages="$errors->get('electionLists')" />
</div>

<div>
    <x-primary-button>{{ __('Uložit') }}</x-primary-button>
    <x-secondary-link :href="route('nominees.index')">{{ __('Zpět') }}</x-secondary-link>
    @if (isset($model->id))
        <x-danger-link data-bs-toggle="modal" data-bs-target="#deleteModal">{{ __('Delete') }}</x-danger-link>
    @endif
</div>
