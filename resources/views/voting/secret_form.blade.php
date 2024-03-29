<div class="row">
    <div class="col text-center">
        <h2>Přihlášení - 2. krok</h2>
    </div>
</div>
<input type="hidden" name="voter_code" value="{{ $model->voter_code }}">
<div class="mt-4">
    <x-input-label for="secret_value">Zadejte členské číslo, které najdete na svojí průkazce ŽOP</x-input-label>
    <x-text-input id="secret_value" type="text" name="secret_value" required autofocus
                inputType="numeric" pattern="[0-9]+" 
                oninvalid="this.setCustomValidity('Členské číslo musí obsahovat pouze číslice')"
                onchange="try{setCustomValidity('')}catch(e){}"
                oninput="setCustomValidity(' ')"
                ></x-text-input>
</div>
<div class="text-end mt-3">
    <x-primary-button>
        Pokračovat
        <i class="bi bi-arrow-right-circle-fill"></i>
    </x-primary-button>
</div>
