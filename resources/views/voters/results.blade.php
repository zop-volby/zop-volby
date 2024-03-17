<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Výsledky voleb') }}
        </h2>
    </x-slot>

    <div class="row">
        {{ $model }}
    </div>
</x-app-layout>
