<div>
    <x-input-label for="name" :value="__('Název')" />
    <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$model->name}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="max_votes" :value="__('Maximální povolený počet hlasů')" />
    <x-text-input id="max_votes" name="max_votes" type="number" required autofocus autocomplete="max_votes" value="{{$model->max_votes}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('max_votes')" />
</div>

<div>
    <x-primary-button>{{ __('Save') }}</x-primary-button>
    <x-secondary-link :href="route('lists.index')">{{ __('Cancel') }}</x-secondary-link>
</div>
