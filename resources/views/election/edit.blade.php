<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Volby') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('election.update', []) }}">
        @csrf
        @method('PUT')
        
        <div>
            <x-input-label for="name" :value="__('Jméno')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$model->name}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="hyperlink" :value="__('Odkaz')" />
            <x-text-input id="hyperlink" name="hyperlink" type="text" required autofocus autocomplete="hyperlink" value="{{$model->hyperlink}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('hyperlink')" />
        </div>

        <div>
            <x-input-label for="start_at" :value="__('Začátek')" />
            <x-text-input id="start_at" name="start_at" type="datetime-local" step="1" required autofocus autocomplete="start_at" value="{{$model->start_at}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('start_at')" />
        </div>

        <div>
            <x-input-label for="end_at" :value="__('Konec')" />
            <x-text-input id="end_at" name="end_at" type="datetime-local" step="1" required autofocus autocomplete="end_at" value="{{$model->end_at}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('end_at')" />
        </div>

        <div>
            <x-input-label for="phase" :value="__('Aktuální fáze')" />
            <div class="form-control btn-group flex-wrap">
                @foreach($model->get_phases() as $phase)
                    <input type="radio" class="btn-check" name="phase" id="{{$phase}}" autocomplete="off" value="{{$phase}}" @if($model->phase == $phase) checked @endif>
                    <label class="btn btn-outline-primary" for="{{$phase}}">{{__('election.phase.' . $phase)}}</label>
                @endforeach                
            </div>
        </div>

        <div>
            <x-primary-button>{{ __('Uložit') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
