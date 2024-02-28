<x-guest-layout>
    <div class="row">
        <div class="col text-center">
            <h1>{{ Election::find(1)->name }}</h1>
        </div>
    </div>
    <form method="POST" action="{{ route('voting.store') }}">
        @csrf
        <div class="row mt-4">
            <div class="col text-center">
                <h2>Přihlášení</h2>
            </div>
        </div>
        <div class="narrow-component">
            <div class="row mt-4">
                <div class="col">
                    <div class="mb-3">
                        <label for="voter_code" class="form-label">Zadejte kód voliče, který jste obdrželi emailem</label>
                        <input type="voter_code" class="form-control" id="voter_code" name="voter_code" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-end">
                    <x-primary-button>Pokračovat</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>