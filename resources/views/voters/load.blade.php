<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Voliči: nahrávání seznamů') }}
        </h2>
        <div class="alert alert-light">
            <i class="bi bi-info-circle"></i>
            Soubor s voliči musí být CSV soubor (comma separated values). 
            Soubor by měl být bez záhlaví, jen řádky s daty.
            První sloupec je kód voliče, druhý sloupec je členské číslo (jen číslice).
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

    <div class="row">
        <div class="col">
            <form method="post" action="{{ route('voters.load') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div>
                    <x-text-input type="file" name="voters_file" id="voters_file"></x-text-input>
                </div>
                <div>
                    <x-primary-button>{{ __('Nahrát') }}</x-primary-button>
                </div>
            </form>            
        </div>
    </div>
</x-app-layout>
