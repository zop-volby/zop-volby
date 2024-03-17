<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Vítejte') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-lg-6 mb-2">
            <div class="card">
                <h3 class="card-header">{{ __('Aktuální volby') }}</h3>
                <div class="card-body">
                    <h5 class="card-title">{{ $model->name }}</h5>
                    <p class="card-text">{{ __('election.phase.' . $model->phase) }}</p>
                    <p class="card-text">{{ __('Začátek hlasování') }}: {{ $model->get_datetime() }}</p>
                </div>
                <div class="card-footer text-end">
                    <x-secondary-link :href="route('election.edit')"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                    @can('mail-voting')
                        <a href="{{ route('voters.scan') }}" class="btn btn-primary">{{ __('Načíst listinné hlasování') }}</a>
                    @endcan
                    @can('inperson-voting')
                        <x-primary-link :href="route('voters.list')">{{ __('Seznam platných kódů') }}</x-primary-link>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <h3 class="card-header">{{ __('Průběh voleb') }}</h3>
                <div class="card-body">
                    <table width="100%">
                        <tr><td class="pe-2" width="1px">{{ $model->get_chart()[1] }}</td><td><div class="text-bg-secondary p-2" style="width:{{ 100*$model->get_chart()[1]/$model->get_chart()[0] }}%"></div></td></tr>
                        <tr><td>{{ $model->get_chart()[2] }}</td><td><div class="text-bg-success p-2" style="width:{{ 100*$model->get_chart()[2]/$model->get_chart()[0] }}%"></div></td></tr>
                        <tr><td>{{ $model->get_chart()[3] }}</td><td><div class="text-bg-info p-2" style="width:{{ 100*$model->get_chart()[3]/$model->get_chart()[0] }}%"></div></td></tr>
                        <tr><td>{{ $model->get_chart()[4] }}</td><td><div class="text-bg-danger p-2" style="width:{{ 100*$model->get_chart()[4]/$model->get_chart()[0] }}%"></div></td></tr>
                    </table>
                </div> 
                <div class="card-footer">
                    <div class="d-flex gap-1">
                        <div class="text-bg-secondary p-1 flex-fill text-center">{{ __('Nezahlasovali') }}</div>
                        <div class="text-bg-success p-1 flex-fill text-center">{{ __('Elektronicky') }}</div>
                        <div class="text-bg-info p-1 flex-fill text-center">{{ __('Listinně') }}</div>
                        <div class="text-bg-danger p-1 flex-fill text-center">{{ __('Neplatně') }}</div>
                    </div>
                </div> 
            </div>  
        </div>
    </div>
</x-app-layout>
