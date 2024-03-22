<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Vítejte') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-lg-6 mb-2">
            @include('widgets.current-election')
        </div>
        <div class="col-lg-6">
            @include('widgets.election-chart')
        </div>
    </div>
</x-app-layout>
