<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ $model->election_name() }}: {{ __('Výsledky voleb') }}
        </h2>
    </x-slot>

    <table class="table">
        @foreach($model->lists() as $list)
            <tr><th colspan="2">{{ $list->list_name(); }}</th></tr>
            @foreach ($list->nominees() as $nominee)
                <tr>
                    <td>
                        {{ $nominee->name }}
                    </td>
                    <td>{{ $nominee->votes }}</td>
                </tr> 
            @endforeach
        @endforeach
    </table>
</x-app-layout>
