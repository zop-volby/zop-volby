<div class="card">
    <h3 class="card-header">{{ __('Aktuální volby') }}</h3>
    <div class="card-body">
        <h5 class="card-title">
            {{ $model->name }}
            <a target="_blank" href="{{ $model->hyperlink }}"><i class="bi bi-box-arrow-up-right"></i></a>
        </h5>
        <p class="card-text">{{ __('election.phase.' . $model->phase) }}</p>
        <p class="card-text">{{ __('Začátek hlasování') }}: {{ $model->get_startdate() }} {{ $model->get_starttime() }}</p>
        <p class="card-text">{{ __('Konec hlasování') }}: {{ $model->get_enddate() }} {{ $model->get_endtime() }}</p>
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
