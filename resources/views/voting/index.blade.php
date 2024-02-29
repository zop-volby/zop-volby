<x-guest-layout>
    <div class="row">
        <div class="col text-center">
            <h1>{{ Election::find(1)->name }}</h1>
        </div>
    </div>
    @if (session('status') !== null)
        <x-alert-danger>{{ session('status') }}</x-alert-danger>
    @endif
    <form method="POST" action="{{ route('voting.store') }}">
        @csrf
        @if ($model->voter_code == null)
            <div class="narrow-component mt-4">
                @include('voting.code_form')
            </div>
        @elseif ($model->secret_token == null)
            <div class="narrow-component mt-4">
                @include('voting.secret_form')
            </div>
        @else
            @include('voting.voting_form')
        @endif
    </form>
</x-guest-layout>