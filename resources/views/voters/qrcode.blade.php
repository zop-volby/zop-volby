<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Naskenujte QR kód') }}
        </h2>
    </x-slot>

    <div id="qrcode_scanner"></div>

    <form method="post" id="voter_form" action="{{ route('voters.qrcode') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="voter_qrcode" id="voter_qrcode">
    </form>            

</x-app-layout>
