<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Voliči: listinné hlasování') }}
        </h2>
    </x-slot>

    <div class="narrow-component row">
        <div class="text-danger col-12">
            Volič s kódem {{ $model->voter_code }} už hlasoval eletronicky 
            a tudíž je jeho listinné hlasování i jeho elektronické hlasování neplatné.
            Elektronické hlasování bylo zrušeno.
            Volební lístky z listinného hlasování odložte stranou a nezapočítávejte je!
        </div>
        <div class="col-12">
            <div class="d-grid mt-2">
                <x-danger-link class="btn-lg" :href="route('voters.scan')">{{ _('Volební listky odloženy') }}</x-danger-button>
            </div>
        </div>
    </div>
</x-app-layout>
