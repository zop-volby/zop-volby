<div>
    <x-input-label for="name" :value="__('Název')" />
    <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$model->name}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="description" :value="__('Popiska')" />
    <x-text-input id="description" name="description" type="text" required autofocus autocomplete="description" value="{{$model->description}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div>
    <x-input-label for="max_votes" :value="__('Maximální povolený počet hlasů')" />
    <x-text-input id="max_votes" name="max_votes" type="number" required autofocus autocomplete="max_votes" value="{{$model->max_votes}}"/>
    <x-input-error class="mt-2" :messages="$errors->get('max_votes')" />
</div>

<div>
    <x-primary-button>{{ __('Save') }}</x-primary-button>
    <x-secondary-link :href="route('lists.index')">{{ __('Cancel') }}</x-secondary-link>
    @if (isset($model->id))
        <x-danger-link data-bs-toggle="modal" data-bs-target="#deleteModal">{{ __('Delete') }}</x-danger-link>
    @endif
</div>
