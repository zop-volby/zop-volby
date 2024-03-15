import { Html5QrcodeScanner } from "html5-qrcode";

function OnScannerResult(scanner: Html5QrcodeScanner, text: string) {
    const input = document.getElementById("voter_qrcode") as HTMLInputElement;
    const form = document.getElementById("voter_form") as HTMLFormElement;
    if (input && form) {
        scanner.clear();
        input.value = text;
        form.submit();    
    }
}

export function BindQrCodeScanner() {
    const scanner = new Html5QrcodeScanner("qrcode_scanner", { fps: 10 }, false);
    scanner.render((text, _) => OnScannerResult(scanner, text), undefined);
}