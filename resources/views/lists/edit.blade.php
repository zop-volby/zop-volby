<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Kandidátní listina') }} {{ $model->name }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('lists.update', ['list'=>$model->id]) }}">
        @csrf
        @method('PUT')
        @include('lists.form')
    </form>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Smazat') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('Opravdu chcete smazat tento záznam?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Zavřít') }}</button>
                    <form id="delete-form" action="{{ route('lists.destroy', ['list'=>$model->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Smazat') }}</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
