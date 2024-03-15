<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Voliči: listinné hlasování') }}
        </h2>
        <div class="alert alert-light">
            <i class="bi bi-info-circle"></i>
            Zadávejte kódy voličů, kterří hlasovali listinným hlasováním.
            Buď opište kód přímo z obálky, nebo naskenujte QR kód.
        </div>
    </x-slot>

    @if ($errors->any()) 
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>    
    @endif
    @if (session('status') !== null)
        <x-alert-success>{{ session('status') }}</x-alert-success>
    @endif

    <div class="row">
        <div class="col-12 col-sm-6 border border-secondary-subtle p-3">
            <form method="post" action="{{ route('voters.scan') }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row align-items-center">
                    <div class="col-auto">
                        <x-input-label for="voter_code" :value="__('Kód voliče')" />
                    </div>
                    <div class="col">
                        <x-text-input name="voter_code" id="voter_code"></x-text-input>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <x-primary-button>{{ __('Vyhledat') }}</x-primary-button>
                    </div>
                </div>
            </form>            
        </div>
        <div class="col-12 col-sm-6 border border-secondary-subtle p-3">
            <div class="d-grid mt-2">
                <x-primary-link class="btn-lg" :href="route('voters.qrcode')">{{ _('Naskenovat QR kod') }}</x-primary-button>
            </div>
        </div>
    </div>
</x-app-layout>
