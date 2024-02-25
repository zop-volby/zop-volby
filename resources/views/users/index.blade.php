<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Uživatelé') }}
        </h2>
    </x-slot>

    <div class="row mb-2">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-search-input id="search-bar"></x-search-input>
                @can('admin')
                    <x-primary-link :href="route('register')">{{ __('Nový uživatel') }}</x-primary-link>
                @endcan
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($users->isEmpty())
                <x-alert-info>{{ __('No users found.') }}</x-alert-info>
            @else
                <div class="table-responsive" id="search-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Jméno') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Aktivní') }}</th>
                                <th>{{ __('Admin') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if ($user->is_active)
                                    	<td class="bg-success"><i class="bi bi-check-square"></i></td>
                                    @else
                                        <td class="bg-warning"><i class="bi bi-check-square"></i></td>
                                    @endif
                                    @if ($user->is_admin)
                                    	<td class="bg-success"><i class="bi bi-check-square"></i></td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td class="text-end">
                                        @can('admin')
                                            <form method="POST" style="display:inline-block;" action="{{ route('users.activate', ['user'=> $user->id]) }}">
                                                @csrf
                                                <x-secondary-button type="submit"><i class="bi bi-check-square"></i></x-secondary-link>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
