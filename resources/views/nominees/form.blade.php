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
    <x-text-input id="biography" name="biography" type="text" required autofocus autocomplete="biography" value="{{$model->biography}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('biography')" />
</div>

<div>
    <x-input-label for="link_to_page" :value="__('Odkaz na stránku')" />
    <x-text-input id="link_to_page" name="link_to_page" type="text" required autofocus autocomplete="link_to_page" value="{{$model->link_to_page}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('link_to_page')" />
</div>

<div>
    <x-primary-button>{{ __('Save') }}</x-primary-button>
    <x-secondary-link :href="route('nominees.index')">{{ __('Cancel') }}</x-secondary-link>
</div>
